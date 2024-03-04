/**
 * SDaiLover Web Packages
 *
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.sdailover.com,
 *              https://www.stephanusdai.web.id
 * @license   : https://www.sdailover.com/license.html
 * @copyright : (c) ID 2023-2024 SDaiLover. All rights reserved.
 * This software has released under the terms of the BSD License.
 */

window.SDaiLover = (function ($) {
    var bind = {
        plugin: {},

        returnConfirm: function() {},

        message: function (message, caption=false) {
            bind.returnConfirm = undefined;
            var $modal = bind.modal.create();
            var container = $('<div/>', {
                                'class': 'col-lg-12'
                            }).appendTo($('<div/>', {
                                'class': 'row'
                            }).appendTo($('<div/>', {
                                'class': 'container-fluid'
                            })));
            var title = $('<h5/>', {'class': 'modal-title fs-6'});
            if (caption!=false) {
                $modal.header($(title).html(caption));
            }
            $modal.body($(container).html(message));
            $modal.footer('Ok');
            $modal.show();
            return;
        },

        confirm: function (message, callback, caption=false) {
            bind.returnConfirm = callback;
            var $modal = bind.modal.create();
            var container = $('<div/>', {
                                'class': 'col-lg-12'
                            }).appendTo($('<div/>', {
                                'class': 'row'
                            }).appendTo($('<div/>', {
                                'class': 'container-fluid'
                            })));
            var title = $('<h5/>', {'class': 'modal-title fs-6'});
            if (caption!=false) {
                $modal.header($(title).html(caption));
            }
            $modal.body($(container).html(message));
            $modal.footer('Yes', 'No');
            $modal.show();
        },

        modal: {
            button: [],
            dialog: [],
            footer: function(okey=false, cancel=false) {
                var $modal = bind.modal.dialog['modal'];
                var content = $('<div/>', {
                    class: 'modal-footer'
                }).appendTo($(bind.modal.dialog['content']));
                var okeyButton = $('<button/>', {
                    type: 'button',
                    class: 'btn btn-primary'
                });
                var cancelButton = $('<button/>', {
                    type: 'button',
                    class: 'btn btn-secondary'
                });
                if (okey!=false) {
                    content.append($(okeyButton).html(okey));
                }
                if (cancel!=false) {
                    content.append($(cancelButton).html(cancel));
                }
                bind.modal.button['oke'] = okeyButton;
                bind.modal.button['cancel'] = cancelButton;
                
                $(okeyButton).on('click', {'$modal':$modal}, function(event) {
                    bind.modal.result = true;
                    if (bind.returnConfirm != undefined) {
                        bind.returnConfirm(event, $modal, true);
                    }
                    $modal.modal('hide');
                });
                $(cancelButton).on('click', {'$modal':$modal}, function(event) {
                    bind.modal.result = false;
                    if (bind.returnConfirm != undefined) {
                        bind.returnConfirm(event, $modal, false);
                    }
                    $modal.modal('hide');
                });
            },
            header: function(content) {
                $('<div/>', {
                    class: 'modal-header'
                }).appendTo($(bind.modal.dialog['content'])).html(content);
            },
            body: function(content) {
                $('<div/>', {
                    class: 'modal-body'
                }).appendTo($(bind.modal.dialog['content'])).html(content);
            },
            create: function() {
                bind.modal.result = false;
                bind.modal.dialog['modal'] = $('<div/>', {
                    id: 'sdConfirmModal',
                    tabindex: '-1',
                    role: 'dialog',
                    class: 'modal fade bd-modal-sm'
                }).appendTo($(document.body));

                bind.modal.dialog['content'] = $('<div/>', {
                    class:'modal-content'
                }).appendTo($('<div/>', {
                    class: 'modal-dialog modal-dialog-centered modal-sm'
                }).appendTo($(bind.modal.dialog['modal'])));

                return this;
            },
            show: function() {
                $modal = bind.modal.dialog['modal'];
                $modal.modal('show');
            },
            hide: function() {
                $modal = bind.modal.dialog['modal'];
                $modal.modal('hide');
            },
            result: false
        },

        setPlugin: function(name, methods) {
            bind.plugin[name] = $.extend({}, bind.plugin[name], methods || {});
        },

        refresh: function() {
            refreshGridview();
        },

        load: function (package) {
            if (package.isActive !== undefined && !package.isActive) {
                return;
            }
            if ($.isFunction(package.init)) {
                package.init();
            }
            $.each(package, function () {
                if ($.isPlainObject(this)) {
                    bind.load(this);
                }
            });
        },
        
        init: function () {
            if (bind.plugin.yiiGridView !== undefined) {
                bind.plugin.yiiGridView.filterUrl();
                if ($.isFunction(bind.plugin.yiiGridView.selectionColumn)) {
                    bind.plugin.yiiGridView.selectionColumn();
                }
            }

            initSidebar();
            initGridview();
        }
    }

    function initSidebar() {
        if ($(this).width() < 767) {
            $('#sidebarMenu').removeClass('show');
            $('#sidebarMenu').addClass('hide');
        } else {
            $('#sidebarMenu').removeClass('hide');
            $('#sidebarMenu').addClass('show');
        }
        $(window).bind('load resize',function(e){
            if ($(this).width() < 767) {
                $('#sidebarMenu').removeClass('show');
                $('#sidebarMenu').addClass('hide');
            } else {
                $('#sidebarMenu').removeClass('hide');
                $('#sidebarMenu').addClass('show');
            }
        });
    }

    function refreshGridview()
    {
        $('.tab-window').each(function() {
            const $tab = $(this);
            let tabId = $tab.attr('id');

            $('.grid-manager', $tab).each(function() {
                const $grid = $(this);
                let gridId = $grid.attr('id');

                $.ajax({
                    url: window.location.href,
                    type: 'GET',
                    data: {'tabId':tabId},
                    dataType: 'json',
                    success: function(xhr) {
                        $($grid).parent().html(xhr);
                        bind.load(window.SDaiLover);
                    },
                    error: function (xhr) {
                        try {
                            const data = JSON.parse(xhr.responseText);
                            bind.message(data.message);
                            console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                        } catch (e) {
                            console.error(e);
                        }
                    }
                });
            });
        });
    }

    function initGridview()
    {
        $('.tab-window').each(function() {
            const $tab = $(this);
            let tabId = $tab.attr('id');

            $('.grid-responsive', $tab).each(function() {
                const $grid = $(this);
                let gridId = $grid.attr('id');

                $('tbody td, a.grid-expand', $grid).unbind('click').bind('click', function(e) {
                    e.preventDefault();
                    let tr = $(this).parent();
                    let span = $(tr).find('.grid-expand').children('span');
                    if ($(this).hasClass('grid-expand')) {
                        tr = $(this).parent().parent();
                        span = $(this).children('span');
                    }
                    tr.toggleClass('expanded');
                    span.removeClass('bi-caret-up-square-fill, bi-caret-up-square-fill');
                    let arrow = tr.hasClass('expanded') ? 'bi-caret-up-square-fill' : 'bi-caret-down-square-fill';
                    span.addClass(arrow);
                    
                    return false;
                });
            });

            $('.grid-manager', $tab).each(function() {
                const $grid = $(this);
                const $gridToolbar = $grid.parent().find('.grid-toolbar');
                let gridToolbarId = $gridToolbar.attr('id');  
                let gridId = $grid.attr('id');
                
                $('.offcanvas-panel').each(function() {
                    const $offCanvas = $(this);
                    let offCanvasId = $offCanvas.attr('id');
                    let offCanvasClose = $offCanvas.find('.btn-close');

                    $('.offcanvas-search', $offCanvas).unbind('submit').bind('submit', function(e) {
                        const $searchForm = $(this);
                        e.preventDefault();
                        $.ajax({
                            url: $searchForm.attr('action') + '?tabId='+tabId,
                            type: 'POST',
                            data: $searchForm.serialize(),
                            dataType: 'json',
                            success: function(xhr) {                    
                                $($grid).parent().html(xhr);
                                bind.load(window.SDaiLover);
                            },
                            error: function (xhr) {
                                try {
                                    const data = JSON.parse(xhr.responseText);
                                    bind.message(data.message);
                                    console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                                } catch (e) {
                                    console.error(e);
                                }
                            }
                        });

                        $(offCanvasClose).trigger('click');                     
                        return false;
                    });                    
                });

                $('.grid-update', $gridToolbar).unbind('click').bind('click', function() {
                    let gridUpdateButton =  $(this);
                    let isBreakLoop = false;
                    $('.form-check-input', $grid).each(function() {
                        let gridInputCheck =  $(this);
                        if (isBreakLoop != false) {
                            return false;
                        } else {
                            if (gridInputCheck.prop('checked') && !gridInputCheck.hasClass('select-on-check-all')) {
                                let urlUpdatePage = gridUpdateButton.attr('data-href');
                                let itemDataId = gridInputCheck.val();
                                try {
                                    isBreakLoop = false;
                                    $tab.sdailoverTabWindow('insert', {newPageUrl: urlUpdatePage+'/'+itemDataId});
                                } catch (e) {
                                    isBreakLoop = true;
                                    console.error(e);
                                }
                            }
                        }
                    });
                });

                $('.grid-export', $gridToolbar).unbind('click').bind('click', function() {
                    let gridExportButton =  $(this);
                    let urlExportPage = gridExportButton.attr('data-href');
                    let itemDataIds = [];
                    let itemFormSent = {};
                    $('.form-check-input', $grid).each(function() {
                        let gridInputCheck =  $(this);
                        if (gridInputCheck.prop('checked') && !gridInputCheck.hasClass('select-on-check-all')) {
                            itemDataIds.push(gridInputCheck.val());
                        }
                    });
                    
                    if(itemDataIds.length > 0) {
                        itemFormSent = {'items':JSON.stringify(itemDataIds)};
                    }
                    $.ajax({
                        url: urlExportPage,
                        type: 'POST',
                        data: itemFormSent,
                        success: function(xhr) {
                            console.log(xhr);
                            var dialogPrint = $('<div/>', {
                                id: 'sdDialogPrint',
                                tabindex: '-1',
                                role: 'dialog',
                                class: 'dialog-print',
                            }).appendTo($(document.body));
                            $(dialogPrint).html(JSON.parse(xhr));
                            window.onafterprint = function() {
                                $(dialogPrint).remove();
                            };                                
                            if (!window.print()) {
                                $(dialogPrint).remove();
                            }
                        },
                        error: function (xhr) {
                            try {
                                const data = JSON.parse(xhr.responseText);
                                bind.message(data.message);
                                console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                            } catch (e) {
                                console.error(e);
                            }
                        }                            
                    });
                });

                $('.grid-delete', $gridToolbar).unbind('click').bind('click', function() {
                    let gridDeleteButton =  $(this);
                    let urlDeletePage = gridDeleteButton.attr('data-href');
                    let itemDataIds = [];
                    $('.form-check-input', $grid).each(function() {
                        let gridInputCheck =  $(this);
                        if (gridInputCheck.prop('checked') && !gridInputCheck.hasClass('select-on-check-all')) {
                            itemDataIds.push(gridInputCheck.val());
                        }
                    });

                    if(itemDataIds.length > 0) {
                        bind.confirm("Removing selected item!<br>Are your sure the continue?", function(event, dialog, result) {
                            if (result==true) {
                                var isBreakLoop = false;
                                $(itemDataIds).each(function(index, itemDataId) {
                                    if (isBreakLoop != false) {
                                        return false;
                                    } else {
                                        $.ajax({
                                            url: urlDeletePage+'/'+itemDataId,
                                            type: 'POST',
                                            data: {'tabId':tabId},
                                            dataType: 'json',
                                            success: function(xhr) {
                                                isBreakLoop = false;
                                                $($grid).parent().html(xhr);
                                                bind.load(window.SDaiLover);
                                            },
                                            error: function (xhr) {
                                                isBreakLoop = true;
                                                try {
                                                    const data = JSON.parse(xhr.responseText);
                                                    bind.message(data.message);
                                                    console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                                                } catch (e) {
                                                    console.error(e);
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        });

                    }
                });
                
                $('.filters input', $grid).unbind('change').bind('change', function(e) {
                    e.preventDefault();
                    let nameFilter =  $(this).attr('name');
                    let valueFilter =  $(this).val();
                    $.ajax({
                        url: window.location.href+'?'+nameFilter+'='+valueFilter,
                        type: 'GET',
                        data: {'tabId':tabId},
                        dataType: 'json',
                        success: function(xhr) {
                            $($grid).parent().html(xhr);
                            bind.load(window.SDaiLover);
                        },
                        error: function (xhr) {
                            try {
                                const data = JSON.parse(xhr.responseText);
                                bind.message(data.message);
                                console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                            } catch (e) {
                                console.error(e);
                            }
                        }
                    });
                    return false;
                });

                $('thead th a.sorting', $grid).unbind('click').bind('click', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('href'),
                        type: 'GET',
                        data: {'tabId':tabId},
                        dataType: 'json',
                        success: function(xhr) {
                            $($grid).parent().html(xhr);
                            bind.load(window.SDaiLover);
                        },
                        error: function (xhr) {
                            try {
                                const data = JSON.parse(xhr.responseText);
                                bind.message(data.message);
                                console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                            } catch (e) {
                                console.error(e);
                            }
                        }
                    });
                    return false;
                });
                
                $('.toolbox .update', $grid).unbind('click').bind('click', function(e) {
                    e.preventDefault();
                    let editPageLink = $(this).attr('href');
                    $tab.sdailoverTabWindow('insert', {newPageUrl: editPageLink});
                    return false;
                });

                $('.toolbox .delete', $grid).unbind('click').bind('click', function(e) {
                    var deleteButton = $(this);
                    e.preventDefault();
                    bind.confirm("Are your sure to delete?", function(event, dialog, result) {
                        if (result==true) {
                            $.ajax({
                                url: deleteButton.attr('href'),
                                type: 'POST',
                                data: {'tabId':tabId},
                                dataType: 'json',
                                success: function(xhr) {
                                    $($grid).parent().html(xhr);
                                    bind.load(window.SDaiLover);
                                },
                                error: function (xhr) {
                                    try {
                                        const data = JSON.parse(xhr.responseText);
                                        bind.message(data.message);
                                        console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                                    } catch (e) {
                                        console.error(e);
                                    }
                                }
                            });
                        }
                    });
                    
                    return false;
                });
            });
        });
    }

    return bind;
})(window.jQuery);

window.jQuery(function () {
    window.SDaiLover.load(window.SDaiLover);
});