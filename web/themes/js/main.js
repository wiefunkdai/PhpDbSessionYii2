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

jQuery(function ($) {
    jQuery(document).ready(function() {
        if (jQuery(this).width() < 767) {
            jQuery('#sidebarMenu').removeClass('show');
            jQuery('#sidebarMenu').addClass('hide');
        } else {
            jQuery('#sidebarMenu').removeClass('hide');
            jQuery('#sidebarMenu').addClass('show');
        }
    });

    jQuery(window).bind('load resize',function(e){
        if (jQuery(this).width() < 767) {
            jQuery('#sidebarMenu').removeClass('show');
            jQuery('#sidebarMenu').addClass('hide');
        } else {
            jQuery('#sidebarMenu').removeClass('hide');
            jQuery('#sidebarMenu').addClass('show');
        }
    });

    var SDaiLover = {
        initGrid: function() {
            jQuery('.tab-window').each(function() {
                const $tab = $(this);
                let tabId = $tab.attr('id');

                jQuery('.grid-responsive', $tab).each(function() {
                    const $grid = $(this);
                    let gridId = $grid.attr('id');
    
                    jQuery('a.grid-expand', $grid).on('click', function(e) {
                        e.preventDefault();
                        let tr = jQuery(this).parent().parent();
                        tr.toggleClass('expanded');
                        let span = jQuery(this).children('span');
                        span.removeClass('bi-caret-up-square-fill, bi-caret-up-square-fill');
                        let arrow = tr.hasClass('expanded') ? 'bi-caret-up-square-fill' : 'bi-caret-down-square-fill';
                        span.addClass(arrow);
                        
                        return false;
                    });
                    
                    jQuery('.filters input', $grid).on('change', function(e) {
                        e.preventDefault();
                        let nameFilter =  jQuery(this).attr('name');
                        let valueFilter =  jQuery(this).val();
                        jQuery.ajax({
                            url: window.location.href+'?'+nameFilter+'='+valueFilter,
                            type: 'GET',
                            data: {'tabId':tabId},
                            dataType: 'json',
                            success: function(xhr) {
                                jQuery($grid).parent().html(xhr);
                                SDaiLover.initGrid();
                            },
                            error: function (xhr) {
                                try {
                                    const data = JSON.parse(xhr.responseText);
                                    alert(data.message);
                                    console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                                } catch (e) {
                                    console.error(e);
                                }
                            }
                        });
                        return false;
                    });

                    jQuery('thead th a.sorting', $grid).on('click', function(e) {
                        e.preventDefault();
                        jQuery.ajax({
                            url: jQuery(this).attr('href'),
                            type: 'GET',
                            data: {'tabId':tabId},
                            dataType: 'json',
                            success: function(xhr) {
                                jQuery($grid).parent().html(xhr);
                                SDaiLover.initGrid();
                            },
                            error: function (xhr) {
                                try {
                                    const data = JSON.parse(xhr.responseText);
                                    alert(data.message);
                                    console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                                } catch (e) {
                                    console.error(e);
                                }
                            }
                        });
                        return false;
                    });
                    
                    jQuery('.toolbox .update', $grid).on('click', function(e) {
                        e.preventDefault();
                        let editPageLink = jQuery(this).attr('href');
                        jQuery('#'+tabId).sdailoverTabWindow('insert', {newPageUrl: editPageLink});
                        return false;
                    });
    
                    jQuery('.toolbox .delete', $grid).on('click', function(e) {
                        e.preventDefault();
                        if (confirm("Are your sure to delete?") == true) {
                            jQuery.ajax({
                                url: jQuery(this).attr('href'),
                                type: 'POST',
                                data: {'tabId':tabId},
                                dataType: 'json',
                                success: function(xhr) {
                                    jQuery($grid).parent().html(xhr);
                                    SDaiLover.initGrid();
                                },
                                error: function (xhr) {
                                    try {
                                        const data = JSON.parse(xhr.responseText);
                                        alert(data.message);
                                        console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                                    } catch (e) {
                                        console.error(e);
                                    }
                                }
                            });
                        }
                        
                        return false;
                    });
                });
            });
        }
    };

    SDaiLover.initGrid();
});