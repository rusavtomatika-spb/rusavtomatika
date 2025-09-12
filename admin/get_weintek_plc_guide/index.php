<?
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/check_catalog_404.php";
global $TITLE, $KEYWORDS, $DESCRIPTION, $CANONICAL;
global $db;
$DESCRIPTION = 'Документация Weintek, eWON';
$SERVER_PROTOCOL = $_SERVER['SERVER_PROTOCOL'] == "HTTP/1.1" ? "http://" : "https://";
$CANONICAL = $SERVER_PROTOCOL . "www.rusavtomatika.com/documents/";
include $_SERVER['DOCUMENT_ROOT'] . "/cms/core/prolog.php";
require '../../sc/lib_new.php';
?>

<script type="text/javascript" src="/js/vue.js"></script>
<script type="text/javascript" src="/js/axios.min.js"></script>
<div id="app">

<div class="document_container">
  <div class="btn btn_start_programm" v-on:click="getArrBrand()">Обновить драйвера <br> смотрите консоль</div>
  <br>
<div class="btn btn_start_programm__small" v-on:click="getArr_homelessCandidate()">Проверить незавершенные загрузки</div>

<br><div class="btn btn_start_programm__small" v-on:click="getArrAllFiles()">Собрать файлы от weintek</div>

</div>

</div>

<style>
   .btn_start_programm{
     color: white;
     background: #44bb6e;
     padding: 10px 20px;
     font-size: 20px;
     display: inline-block;
     cursor: pointer;
   }
   .btn_start_programm__small{
     margin-top: 20px;
     color: white;
     background: grey;
     padding: 5px 10px;
     font-size: 15px;
     display: inline-block;
     cursor: pointer;
   }
   .document_container{
     text-align: center;
   }
</style>
<script>
    new Vue({
        el: '#app',
        data: {
            arrAllFiles: [],
            arrResultLinks: [],
            arrResultFullBrand: [],
            arrAfterProcessingData: [],
            arrCandidateOnDownload: [],
            arrSuccessCandidate: [],
            arrOriginBrand: [],
            arrReworkCandidate: [],
            arrNotificationNew: [],
            arrNotificationUpdate: [],
            password: "3319333",
        },
        methods:  {
          getArrAllFiles: function () {
              password = this.password;
              axios.post('/admin/get_weintek_plc_guide/getArrAllFiles.php', {password}).then((response) => {

              console.log("Обнаружено файлов: " + response.data.length);
              this.preparingArrAllFiles(response.data);
              console.log("Нужных файлов: " + this.arrAllFiles.length);
              console.log(this.arrAllFiles);


              });
          },
          preparingArrAllFiles: function (arrFiles){

            currentContext = this;
            currentContext.arrAllFiles = [];
            url = document.createElement('a');
              counter = 0;
            arrFiles.forEach(function (item, i, arr) {

                dataJSON = {};
                if (

                    !item.url.includes("/jpn/") &&
                    !item.url.includes("/cht/") &&
                    !item.url.includes("/jap/") &&
                    !item.url.includes("_jpn") &&
                    !item.url.includes("_cht") &&
                    !item.url.includes("_tw") &&
                    !item.url.includes("_jp") &&
                    !item.url.includes("/MT600/") &&
                    !item.url.includes("/MT8000/") &&
                    !item.url.includes("/MT500/") &&
                    !item.url.includes(".zip") &&
                    !item.url.includes(".apk") &&
                    !item.url.includes(".package") &&
                    !item.url.includes(".cmtp") &&
                    !item.url.includes(".ccmp") &&
                    !item.url.includes(".ecmp") &&
                    !item.url.includes(".rar") &&
                    !item.url.includes(".dwg") &&
                    !item.url.includes(".bin") &&
                    !item.url.includes(".emtp") &&
                    !item.url.includes(".htm") &&
                    !item.title.includes("(Japanese)") &&
                    !item.title.includes("(Traditional Chinese)") &&
                    !item.title.includes("HMI Pin Assignment")


                ) {

                    url.href = item.url;
                    let arrDocumentUrlOriginPath = url.pathname.split("/");


/*
                    switch (arrDocumentUrlOriginPath[2]) {
                      case "Document":
                      dataJSON.documentSubSection  = "Часто задаваемые вопросы";
                      break;
                      case "EasyAccess20":
                      dataJSON.documentSubSection  = "Удаленный доступ EasyAccess 2.0";
                      break;
                      case "EBPro":
                      dataJSON.documentSubSection  = "Среда разработки EasyBuilder Pro";
                      break;
                      case "cMT":
                      dataJSON.documentSubSection  = "Серия cMT";
                      break;
                      case "iR":
                      dataJSON.documentSubSection  = "Модули ввода-вывода серии iR";
                      break;
                      case "MT8000iP":
                      dataJSON.documentSubSection  = "Серия MT8000iP";
                      break;
                      case "eMT3000":
                      dataJSON.documentSubSection  = "Серия eMT3000";
                      break;
                      case "MT8000iE":
                      dataJSON.documentSubSection  = "Серия MT8000iE";
                      break;
                      case "MT8000XE":
                      dataJSON.documentSubSection = "Серия MT8000iE";
                      break;
                      case "mTV":
                      dataJSON.documentSubSection  = "Серия mTV";
                      break;
                      default:
                      dataJSON.documentSubSection = arrDocumentUrlOriginPath[2]; // subSection
                    }
*/
                    dataJSON.counter = counter;

                    dataJSON.documentSection = "Weintek"; // section

                    arrDocumentUrlOriginPath.splice(0, 2);
                    arrDocumentUrlOriginPath = arrDocumentUrlOriginPath.join('/')

                    dataJSON.documentEngUrl = "https://www.rusavtomatika.com/upload_files/documents/weintek/" + arrDocumentUrlOriginPath; // url eng

                    this.dataJSON.documentOriginUrl = item.url; // origin url for meta data

                    nameFormatPos = url.pathname.split("/").pop().lastIndexOf(".") + 1;

                    dataJSON.documentFormat = url.pathname.split("/").pop().substr(nameFormatPos); // format


                    dataJSON.documentName = item.title.replace('(English)', ''); // name

                    //await this.pullDataToPhpAjax(dataJSON);



                    currentContext.arrAllFiles.push(dataJSON);


                //    counter++;


                }

            });
          },
          getArrBrand: function () {
            password = this.password;
            axios.post('/admin/get_weintek_plc_guide/getArrBrand.php', {password}).then((response) => {

              this.arrOriginBrand = response.data;

              arrResultLinks = this.arrResultLinks;
              this.arrOriginBrand.forEach(element => {
                elementRework = element.Com;
                elementRework = elementRework.replace(/\s+/g, "+");
                elementRework = elementRework.replace(/\//g, "%2F");
                elementRework = elementRework.replace(/,+/g, "%2C");
                elementRework = elementRework.replace(/&+/g, "%26");

                  this.arrResultLinks.push(elementRework);

              });
              if(this.arrResultLinks.length > 0){
                this.createArr_ForSend();
              }else{console.log("нечего парсить");}

            });

          },

            createArr_ForSend: function () {
               console.log("получение данных осталось - " + this.arrResultLinks.length);
               let data = this.arrResultLinks.shift();

               password = this.password;
              axios.post('/admin/get_weintek_plc_guide/pullAjaxDataFromWeintek.php', {data, password}).then((response) => {

                if(response.data && response.data !== ""){


                  data = data.replace(/\+/g, " ");
                  data = data.replace(/%2F/g, "/");
                  data = data.replace(/%2C/g, ",");
                  data = data.replace(/%26/g, "&");

                    response.data.push({"brand" : data});
                    this.arrResultFullBrand.push(response.data);

                    console.log(response.data);

                }
                    if(this.arrResultLinks.length > 0){
                        this.createArr_ForSend();
                    }else{
                    console.log("[20%] - получили данные с Weintek");
                      this.sendArr_ForProcessingOnServer();
                      return;
                    }

              });

            },
            sendArr_ForProcessingOnServer: function () {
              let data = this.arrResultFullBrand.shift();
              password = this.password;
              axios.post('/admin/get_weintek_plc_guide/processingData.php', {data, password}).then((response) => {

                console.log(this.arrResultFullBrand.length);
                this.arrAfterProcessingData.push(response.data);
                 if(this.arrResultFullBrand.length > 0){
                      this.sendArr_ForProcessingOnServer();
                  }else{
                    console.log("[40%] - переработали данные");
                    this.sendArr_ForAddOnServer();
                    return;
                  }

              });


            },
            sendNotification: function (updateDoc, newDoc) {
              password = this.password;

              axios.post('/admin/get_weintek_plc_guide/ajaxSendNotification.php', {updateDoc,newDoc, password}, {headers: {"Content-type": "application/x-www-form-urlencoded"}}).then((response) => { console.log(response.data);});
            },
              sendArr_ForAddOnServer: function () {
                let data = this.arrAfterProcessingData.shift();
                  password = this.password;
                axios.post('/admin/get_weintek_plc_guide/addData.php', {data, password}).then((response) => {

if(response.data.updateDocument){
  response.data.updateDocument.forEach((e) =>  {
    this.arrCandidateOnDownload.push(e);
    this.arrNotificationNew.push(e);
  });
}
if(response.data.newDocument){
  response.data.newDocument.forEach((e) =>  {
    this.arrCandidateOnDownload.push(e);
    this.arrNotificationUpdate.push(e);
  });
}

                  console.log(this.arrCandidateOnDownload);
                   if(this.arrAfterProcessingData.length > 0){
                        this.sendArr_ForAddOnServer();
                    }else {

                        this.sendNotification(this.arrNotificationUpdate, this.arrNotificationNew);
                      console.log("[60%] - сравнили данные с базой данных");
                      console.log("Новые кандидаты:");
                      console.log(this.arrCandidateOnDownload);
                      this.sendArr_ForDownloadOnServer();


                      return;
                    }

                });

              },
              sendArr_ForDownloadOnServer: function () {
                let data = this.arrCandidateOnDownload.shift();
                password = this.password;


                axios.post('https://www.rusavtomatika.com/upload_files/ajax_scripts/ajaxDownloadDataForDocuments.php', {data, password}, {headers: {"Content-type": "application/x-www-form-urlencoded"}}).then((response) => {

                  this.arrSuccessCandidate.push(response.data.successDownload);
                   if(this.arrCandidateOnDownload.length > 0){
                        this.sendArr_ForDownloadOnServer();
                    }else {

                      console.log("[80%] - скачали актуальные файлы на сервер");
                      this.sendArr_ChengeCandidateStatus();
                      return;
                    }

                });

              },
              sendArr_ChengeCandidateStatus: function () {
                let data = this.arrSuccessCandidate.shift();
                password = this.password;
                axios.post('/admin/get_weintek_plc_guide/changeCandidate.php', {data, password}).then((response) => {
                   if(this.arrSuccessCandidate.length > 0){
                        this.sendArr_ChengeCandidateStatus();
                    }else{
                      console.log("[100%] - драйвера плк обнавлены");
                    }

                });

              },
              getArr_homelessCandidate: function () {
                password = this.password;
                axios.post('/admin/get_weintek_plc_guide/forcedAddHomelessCanditate.php', {password}).then((response) => {
                  this.arrCandidateOnDownload.push(response.data);
                  this.sendArr_ForDownloadOnServer();

                });

              },



        }
    });
</script>
