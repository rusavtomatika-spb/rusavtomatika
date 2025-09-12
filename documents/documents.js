
const routes = []
const router = new VueRouter({

  routes,
  mode: 'history',


});


new Vue({
    router,
    el: '#app',
	data: {
        url: {
            save_cash: '/documents/ajax_cash.php',
        },
        currentFilter: undefined,
        currentSection: undefined,
        currentH1: "",
        documents: [],
        sections: [],
        currentSubSections: [],
        title: "Weintek документы, руководство, мануалы, документация",
        keywordSearchTitle: '',
        keywordSearchBrand: '',
    },
    metaInfo(){
        title = this.title;
        return {
             title: title ? title : "some placeholder title",
             meta: [
                { property: 'og:title', content: title },
        { property: 'og:image', content: 'https://www.rusavtomatika.com/upload_files/images/openGraph_images/documents.png' },
        { property: 'og:site_name', content: 'Русавтоматика' },
        {property: 'og:type', content: 'website'},
             ]
         }
    },

    created() {

        axios.get('/documents/documents_get_ajax.php').then((response) => {
                this.documents = response.data.documents;
                this.sections = response.data.sections;

                this.setInitSection();


            }).then( () => {

              this.send_cash();
              const rendering_content_dest = document.querySelector('#rendering_content_dest');
              if (rendering_content_dest !== null) {
                  rendering_content_dest.innerHTML = '';
              }
          });
    },
    mounted: function () {


    },
    computed: {
      documentsFiltred() {
      return this.documents.filter((document) => {
    let boolenFilter = false;
    let addition_title = "";
    if(this.keywordSearchTitle !== ''){
      if(document.title_translate){
        addition_title = document.title + document.title_translate;
      }else{addition_title = document.title;}

      boolenFilter = addition_title.toLowerCase().includes(this.keywordSearchTitle.toLowerCase());
    }else{
      boolenFilter = document.brand.toLowerCase().includes(this.keywordSearchBrand.toLowerCase());
    }
    return boolenFilter;
      });
},


    },

	methods: {
    send_cash: function () {
        const html_content = document.querySelector('#rendering_content_source');
        if (html_content !== null) {
            axios({
                method: 'POST',
                url: this.url.save_cash,
                data: {
                    html: html_content.innerHTML,
                    page: window.location,
                },
                headers: {
                    "Content-type": "application/x-www-form-urlencoded"
                }
            }).then((response) => {

            });
        }
    },
    boolShowSubSection: function (e) {
      let counter = 0;
      this.documentsFiltred.forEach((item, i) => {
        if(item.subSection.indexOf(e) >= 0){counter = 1;}
      });

  if (counter === 1) {
    return true;
  }
    },
    showSubSection: function () {
      console.log(this);
    },
    clearFilterField: function() {
    this.keywordSearchTitle = '';
    this.keywordSearchBrand = '';
        },
		setFilter: function(section, subSection) {
      this.send_cash();
            this.clearFilterField();
            this.currentFilter = section;
            this.currentSection = subSection;
            this.setCurrentH1(this.currentFilter,this.currentSection);

        },
        getListSubSections: function() {
            currentContext = this;
            this.currentSubSections = [];
            console.log(this.sections);

            this.sections.forEach(function(item, i, arr) {
                if(currentContext.currentFilter === item.title){

                    item.subSections.forEach(function(item, i, arr) {
                        currentContext.currentSubSections.push(item.title);
                    });
                }

            });

        },
        setFirstSubSection: function(){
            if ( this.$route.query.section !== undefined){
                this.currentFilter = this.$route.query.section;
                if ( this.$route.query.subSection !== undefined) {
                    this.currentSection = this.$route.query.subSection;
                }else{
                    count = 0;
                    for (var key in this.sections) {
                        if(this.currentFilter === this.sections[keysSections[count]].title){
                            this.currentSection = this.sections[keysSections[count]].subSections[0].title;
                            break;
                        }
                        count ++;
                    }
                }
            }

        },
        setInitSection: function() {

        if ( this.$route.query.section !== undefined){
                this.currentFilter = this.$route.query.section;
                if ( this.$route.query.subSection !== undefined) {
                    this.currentSection = this.$route.query.subSection;
                }
            }else{
                keysSections = Object.keys(this.sections);
            this.currentFilter = this.sections[keysSections[0]].title;
            router.push({query: { section: this.currentFilter }}).catch(() => {});
            }
            this.getListSubSections();
            this.setCurrentH1(this.currentFilter,this.currentSection);

        },
        setCurrentH1: function(section, subSection){
            this.currentFilter
            if(subSection === undefined){
                this.currentH1 = "Документы - " + section;

            }else{
                this.currentH1 = "Документы - " + section + " - " + subSection;
            }
            this.title = this.currentH1;
            //document.title = this.currentH1

            this.setCastomMeta(this.currentH1);

        },
        setSection: function(section) {
        this.clearFilterField();
        this.currentFilter = section;
        this.currentSection = undefined;
        this.getListSubSections();
            this.setCurrentH1(this.currentFilter, this.currentSection);
        },
        setCastomMeta: function(determinant) {
            switch (determinant) {
                case "Документы - Weintek":
                    this.currentH1 = "Weintek документация, мануалы, руководство, документы";
                    this.title = "Weintek документы, руководство, мануалы, документация";
                  break;
              }
        }
	}
})
