$(document).ready(function () {
    if (document.querySelector("#main_page__block_contacts")) {
        $(window).scroll(function () {
            load_content("#main_page__block_contacts", "/include_utf_8/main_page/content/block_contacts_content.php");
        });
    }
    if (document.querySelector("#main_page__block_big_slider")) {
        load_content("#main_page__block_big_slider", "/include_utf_8/main_page/content/block_big_banner3_content.php", 2000);
    }
});


function load_content(block_id, ajax_url, timeout = 1) {
    var wt = $(window).scrollTop();
    var wh = $(window).height();
    var et = $(block_id).offset().top;
    var eh = $(block_id).outerHeight();
    var dh = $(document).height();
    if (wt + wh >= et || wh + wt == dh || eh + et < wh) {
        if (!$('#main_page__block_contacts').hasClass('replacing')) {

            $("#main_page__block_contacts").addClass('replacing');
            setTimeout(function () {
                $.ajax({
                    url: ajax_url,
                    method: 'POST',
                }).done(function (data) {
                    if (data.length > 0) {
                        $(block_id).append(data);
                        console.log('Элемент ' + block_id + ' показан');
                    }
                });
            }, timeout);
        }
    }
}

if (document.querySelector("#glide_news")) {
    new Glide('#glide_news',
        {
            type: 'slider',
            bound: true,
            rewind: false,
            startAt: 0,
            perView: 5,
            gap: 10,
            autoplay: false,
            focusAt: 0,
            peek: {
                before: 0,
                after: 100
            },

            breakpoints: {
                1024: {
                    perView: 3,
                    peek: {
                        before: 0,
                        after: 50
                    },
                },
                768: {
                    perView: 2,
                    peek: {
                        before: 0,
                        after: 50
                    },
                },
                480: {
                    perView: 1,
                    peek: {
                        before: 0,
                        after: 50
                    },
                }
            }
        }).mount()
}


new Glide('#glide_video',
    {
        type: 'slider',
        bound: true,
        rewind: false,
        startAt: 0,
        perView: 4,
        gap: 10,
        autoplay: false,
        focusAt: 0,
        peek: {
            before: 0,
            after: 200
        },

        breakpoints: {
            1024: {
                perView: 3,
                peek: {
                    before: 0,
                    after: 50
                },
            },
            768: {
                perView: 2,
                peek: {
                    before: 0,
                    after: 50
                },
            },
            480: {
                perView: 1,
                peek: {
                    before: 0,
                    after: 50
                },
            }
        }
    }).mount()

new Glide('#glide_new_products',
    {
        type: 'slider',
        bound: true,
        rewind: false,
        startAt: 0,
        perView: 4,
        gap: 10,
        autoplay: false,
        focusAt: 0,
        peek: {
            before: 0,
            after: 200
        },
        breakpoints: {
            1024: {
                perView: 3,
                peek: {
                    before: 0,
                    after: 50
                },
            },
            768: {
                perView: 2,
                peek: {
                    before: 0,
                    after: 50
                },
            },
            480: {
                perView: 1,
                peek: {
                    before: 0,
                    after: 50
                },
            }
        }
    }).mount()

new Glide('#glide_now_in_stock_slider',
    {
        type: 'carousel',
        startAt: 0,
        perView: 5,
        gap: 10,
        autoplay: 2000,
        focusAt: 0,
        peek: {
            before: 0,
            after: 100
        },

        breakpoints: {
            1024: {
                perView: 3,
                peek: {
                    before: 0,
                    after: 50
                },
            },
            768: {
                perView: 2,
                peek: {
                    before: 0,
                    after: 50
                },
            },
            480: {
                perView: 1,
                peek: {
                    before: 0,
                    after: 50
                },
            }
        }
    }).mount()

new Glide('#glide_sphere',
    {
        type: 'carousel',
        startAt: 0,
        perView: 3,
        gap: 0,
        autoplay: 3000,
        focusAt: 0,
        peek: {
            before: 0,
            after: 150
        },

        breakpoints: {
            1199: {
                perView: 3,
                peek: {
                    before: 0,
                    after: 50
                },
            },
            991: {
                perView: 2,
                peek: {
                    before: 0,
                    after: 150
                },
            },
            700: {
                perView: 2,
                peek: {
                    before: 0,
                    after: 50
                },
            },
            480: {
                perView: 1,
                peek: {
                    before: 0,
                    after: 50
                },
            }
        }
    }).mount()










