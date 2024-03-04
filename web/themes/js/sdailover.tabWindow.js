/**
 * SDaiLover Tabular Widget for Yii Framework Packages
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
 * This software using Yii Framework has released under the terms of the BSD License.
 */

(function ($) {
    /**
     * Copyright (c) ID 2024 SDaiLover (https://www.sdailover.com).
     * All rights reserved.
     *
     * Licensed under the Clause BSD License, Version 3.0 (the "License");
     * you may not use this file except in compliance with the License.
     * You may obtain a copy of the License at
     *
     *      http://www.sdailover.com/license.html
     *
     * This software is provided by the SDAILOVER and
     * CONTRIBUTORS "AS IS" and Any Express or IMPLIED WARRANTIES, INCLUDING,
     * BUT NOT LIMITED TO, the implied warranties of merchantability and
     * fitness for a particular purpose are disclaimed in no event shall the
     * SDaiLover or Contributors be liable for any direct,
     * indirect, incidental, special, exemplary, or consequential damages
     * arising in anyway out of the use of this software, even if advised
     * of the possibility of such damage.
     * See the License for the specific language governing permissions and
     * limitations under the License.
     */
    
    $.fn.sdailoverTabWindow = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist in jQuery.sdailoverTabWindow');
            return false;
        }
    }

    var defaults = {
        action: undefined,
        defaultPageId: undefined,
        addTabButtonCaption: undefined,
        closeTabButtonCaption: undefined,
        closeTabButtonCssClass: undefined,
        promptPageClose: undefined,
        addTabButton: undefined,
        tabContentId: undefined,
        newPageLabel: undefined,
        newPageUrl: undefined,
        newPageContent: undefined,
        newPageCssClass: undefined,
        navbarButtonCssClass: undefined,
        enableClosePageButton: undefined,
        tabPageSelector: undefined,
        enableConfirmOnWindowClosed: undefined
    };

    var sdTabWindows = {};

    var tabNavs = {};
    var tabPages = {};
    var tabPageLinks = {};

    var tabEvents = {
        beforeChange: 'beforeChange',
        afterChange: 'afterChange'
    }

    var tabEventHandlers = {};

    var tabCount = 0;
    
    var methods = {
        init: function (options) {
            return this.each(function () {
                var $e = $(this);
                var settings = $.extend({}, defaults, options || {});
                var id = $e.attr('id');
                if (sdTabWindows[id] === undefined) {
                    sdTabWindows[id] = {};
                }

                sdTabWindows[id] = $.extend(sdTabWindows[id], {settings: settings});
                var tabEvents = 'change.sdailoverTabWindow click.sdailoverTabWindow';
                var enterPressed = false;
                initEventHandler($e, 'change', tabEvents, settings.tabPageSelector, function (event) {
                    var elementId = event.target.parentElement.id || event.target.id;
                    if (event.type === 'click') {
                        if (elementId === settings.addTabButton) {
                            settings.action = 'insert';
                        } else if (event.target.parentElement.classList.contains('nav-close') 
                            || event.target.classList.contains('nav-close')) {
                            settings.action = 'remove';
                        } else {
                            settings.action = 'select';
                            enterPressed = true;
                        }
                    } else {
                        if (enterPressed) {
                            enterPressed = false;
                            return;
                        }
                    }

                    methods.applyChange.apply($e);

                    return false;
                })
            });
        },

        applyChange: function () {
            var $tab = $(this);
            let tabId = $tab.attr('id');
            var settings = sdTabWindows[tabId].settings;

            var event = $.Event(tabEvents.beforeChange);
            $tab.trigger(event);
            if (event.result === false) {
                return;
            }

            if (settings.action === 'insert') {
                methods.insert.apply($tab);
            } else if (settings.action === 'remove') {
                methods.remove.apply($tab);
            }

            $tab.trigger(tabEvents.afterChange);
        },

        insert: function(options) {
            var $tab = $(this);
            let tabId = $tab.attr('id');
            var settings = sdTabWindows[tabId].settings;

            let newTabLabel = settings.newPageLabel;
            let newPageUrl = settings.newPageUrl;
            if (options != undefined) {
                if (options.newPageLabel!=undefined) {
                    newTabLabel = options.newPageLabel;
                }
                if (options.newPageUrl!=undefined) {
                    newPageUrl = options.newPageUrl;
                }
            }
            let newPageContent = '';
            newTabLabel = newTabLabel.replace(' ', '');
            newTabLabel = newTabLabel.replace(/[^A-Za-z0-9\-]/g, '');
            newTabLabel = newTabLabel.charAt(0).toLowerCase() + newTabLabel.slice(1);
            newTabLabel += tabCount + 1;
            let idNewTab = 'tab' + newTabLabel.charAt(0).toUpperCase() + newTabLabel.slice(1);
            let idNewNavTab = newTabLabel + '-navtab';

            const newTabButton = document.createElement('button');
            const newTabButtonCaption = document.createElement('span');
            $(newTabButtonCaption).attr('class', 'nav-caption');
            $(newTabButtonCaption).html(settings.newPageLabel + ' ' + (tabCount + 1));
            $(newTabButton).attr('id', idNewNavTab);
            $(newTabButton).attr('data-bs-toggle', 'tab');
            $(newTabButton).attr('data-bs-target', '#' + idNewTab);
            $(newTabButton).attr('aria-controls', newTabLabel);
            $(newTabButton).attr('class', settings.navbarButtonCssClass);
            $(newTabButton).attr('aria-selected', 'false');
            $(newTabButton).attr('role', 'tab');
            $(newTabButton).attr('type', 'button');
            $(newTabButton).html(newTabButtonCaption);
            if (settings.enableClosePageButton!=false) {
                const closeTabButton = document.createElement('a');
                $(closeTabButton).attr('href', '#');
                $(closeTabButton).attr('type', 'button');
                $(closeTabButton).attr('class', 'nav-close');
                $(closeTabButton).addClass(settings.closeTabButtonCssClass);
                $(closeTabButton).html(settings.closeTabButtonCaption);
                $(newTabButton).append(closeTabButton);
            }

            if (newPageUrl == undefined || newPageUrl == false) {
                newPageContent = settings.newPageContent;
                if (options!=undefined && options.newPageContent!=undefined) {
                    newPageContent = options.newPageContent;

                }
                const newTabPane = document.createElement('div');
                $(newTabPane).addClass(settings.newPageCssClass);                
                $(newTabPane).attr('id', idNewTab);
                $(newTabPane).attr('role', 'tabpanel');
                $(newTabPane).attr('aria-labelledby', idNewNavTab);
                $(newTabPane).html(newPageContent);
                $('#' + tabId + ' #' + settings.tabContentId).append(newTabPane);
                tabPages[idNewTab] = newTabPane;
                tabNavs[idNewNavTab] = newTabButton;
                $('#' + tabId + ' .nav-tabs button').eq(-1).before(newTabButton);
                methods.setSelectionTab.apply($tab, [{
                    pageId: idNewTab
                }]);
                methods.promptUnload.apply($tab);
            } else {         
                if (tabPageLinks[newPageUrl]===undefined) {    
                    $.ajax({
                        url: newPageUrl,
                        type: 'GET',
                        data: {'tabId': tabId, 'tabPageId': idNewTab, 'tabNavId': idNewNavTab},
                        dataType: 'json',
                        success: function(xhr) {
                            const newTabPane = document.createElement('div');
                            $(newTabPane).addClass(settings.newPageCssClass);
                            $(newTabPane).attr('id', idNewTab);
                            $(newTabPane).attr('role', 'tabpanel');
                            $(newTabPane).attr('aria-labelledby', idNewNavTab);
                            $(newTabPane).html(xhr);
                            tabPages[idNewTab] = newTabPane;
                            tabNavs[idNewNavTab] = newTabButton;
                            $('#' + tabId + ' #' + settings.tabContentId).append(newTabPane);
                            $('#' + tabId + ' .nav-tabs button').eq(-1).before(newTabButton);
                            if (newPageUrl!==settings.newPageUrl) {
                                tabPageLinks[newPageUrl] = idNewTab;
                            }
                            methods.setSelectionTab.apply($tab, [{
                                pageId: idNewTab
                            }]);
                            methods.promptUnload.apply($tab);
                        },
                        error: function (xhr) {
                            try {
                                const data = JSON.parse(xhr.responseText);
                                SDaiLover.message(data.message);
                                console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                            } catch (e) {
                                console.error(e);
                            }
                        }
                    });
                } else {
                    var lastPageId = tabPageLinks[newPageUrl];
                    methods.setSelectionTab.apply($tab, [{
                        pageId: lastPageId
                    }]);
                } 
            }

            tabCount++;
        },

        promptUnload: function() {
            var $tab = $(this);
            let tabId = $tab.attr('id');
            var settings = sdTabWindows[tabId].settings;
            if (settings.enableConfirmOnWindowClosed) {
                $(tabPages).each(function(tabPage) {
                    $('form input[type="text"]', tabPage).each(function(e) {
                        $(this).on('blur', function(event) {
                            if (event.target.value !== "") {
                                $(window).bind("beforeunload",function warnUsers(event) {
                                    return "Are you ready to exit this page?\nYou have some unsaved changes!";
                                });
                            }
                        });
                    });
                });
            }
        },

        updateTitleTab: function (options) {
            let tabNavId = options.tabNavId;

            if (tabNavId in tabNavs) {
                if (options.formTitle === '' || typeof options.formTitle === 'undefined') {
                    options.formTitle = 'Form ' + tabCount;
                }
                $('span.nav-caption', tabNavs[tabNavId]).html(options.formTitle);
            }
        },

        sendAjaxFormTab: function(options) {
            var $tab = $(this);
            let tabId = $tab.attr('id');
            var settings = sdTabWindows[tabId].settings;
            
            let tabPageId = undefined;
            let tabNavId = undefined;
            if (options=='undefined') {
                tabPageId = options.tabPageId;
                tabNavId = options.tabNavId;
            } else {
                tabPageId = $('.tab-content .tab-pane.active', $tab).attr('id');
                tabNavId = $('.nav-tabs .nav-link.active', $tab).attr('id');
            }

            if (tabPageId in tabPages) {
                const formTabPage = $(options.activeFormId, tabPages[tabPageId]);
                let ajaxPageUrl = formTabPage.attr('action');
          
                $.ajax({
                    url: ajaxPageUrl,
                    type: 'POST',
                    data: formTabPage.serialize(),
                    dataType: 'json',
                    success: function(xhr) {
                        const isSuccessfull = $(xhr).hasClass('form-success');
                        
                        $('#'+tabPageId, $tab).html(xhr);
                        SDaiLover.refresh();

                        if (isSuccessfull && options.isRemoveTab) {
                            tabCount--;
                            for (const [tabLink, linkId] of Object.entries(tabPageLinks)) {
                                if (linkId == tabPageId) {
                                    delete tabPageLinks[tabLink];
                                }
                            }
                            $('#'+tabPageId, $tab).remove();
                            $('#'+tabNavId, $tab).remove();
                            delete tabPages[tabPageId];
                            delete tabNavs[tabNavId];                            
            
                            if (tabCount==0) {
                                $(window).unbind('beforeunload');
                            }
                            
                            methods.setSelectionTab.apply($tab, [{
                                pageId: settings.defaultPageId
                            }]);                  
                        }
                    },
                    error: function (xhr) {
                        try {
                            const data = JSON.parse(xhr.responseText);
                            SDaiLover.message(data.message);
                            console.warn('Error ' + xhr.status + ":\n" + xhr.responseText);
                        } catch (e) {
                            console.error(e);
                        }
                    }
                });
            }
        },

        setSelectionTab: function (options) {
            var $tab = $(this);
            let tabId = $tab.attr('id');
            
            if (sdTabWindows[tabId] === undefined) {
                sdTabWindows[tabId] = {};
            }

            var trigger = document.querySelector('#' + tabId + ' .nav-tabs button[data-bs-target="#' + options.pageId + '"]');
            var tabPageSelected = new bootstrap.Tab(trigger);
            tabPageSelected.show();
        },

        remove: function (options) {
            var $tab = $(this);
            let tabId = $tab.attr('id');
            var settings = sdTabWindows[tabId].settings;
            
            let tabPageId = undefined;
            let tabNavId = undefined;
            if (options=='undefined') {
                tabPageId = options.tabPageId;
                tabNavId = options.tabNavId;
            } else {
                tabPageId = $('.tab-content .tab-pane.active', $tab).attr('id');
                tabNavId = $('.nav-tabs .nav-link.active', $tab).attr('id');
            }

            SDaiLover.confirm(settings.promptPageClose, function(event, dialog, result) {
                if (result == true) {
                    tabCount--;
                    for (const [tabLink, linkId] of Object.entries(tabPageLinks)) {
                        if (linkId == tabPageId) {
                            delete tabPageLinks[tabLink];
                        }
                    }
                    $('#'+tabPageId, $tab).remove();
                    $('#'+tabNavId, $tab).remove();
                    delete tabPages[tabPageId];
                    delete tabNavs[tabNavId];
                    
    
                    if (tabCount==0) {
                        $(window).unbind('beforeunload');
                    }
                    
                    methods.setSelectionTab.apply($tab, [{
                        pageId: settings.defaultPageId
                    }]);
                }
            });
        },

        destroy: function () {
            var events = ['.sdailoverTabWindow', tabEvents.beforeChange, tabEvents.afterChange].join(' ');
            this.off(events);

            var id = $(this).attr('id');
            $.each(tabEventHandlers[id], function (type, page) {
                $(document).off(page.event, page.selector);
            });

            delete sdTabWindows[id];

            return this;
        },

        tab: function () {
            var id = $(this).attr('id');
            return sdTabWindows[id];
        }
    };

    function initEventHandler($tabWindow, type, event, selector, callback) {
        var id = $tabWindow.attr('id');
        var prevHandler = tabEventHandlers[id];
        if (prevHandler !== undefined && prevHandler[type] !== undefined) {
            var page = prevHandler[type];
            $(document).off(page.event, page.selector);
        }
        if (prevHandler === undefined) {
            tabEventHandlers[id] = {};
        }
        $(document).on(event, selector, callback);
        tabEventHandlers[id][type] = {event: event, selector: selector};
    }
})(window.jQuery);