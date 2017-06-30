jsBackend =
{
    debug: false,

    // init, something like a constructor
    init: function()
    {
        // init stuff
        jsBackend.controls.init();
        jsBackend.forms.init();
        jsBackend.layout.init();
    }
}

/**
 * Handle form functionality
 */
jsBackend.controls =
{
    // init, something like a constructor
    init: function()
    {
        jsBackend.controls.bindPasswordStrengthMeter();
    },

    bindPasswordStrengthMeter: function()
    {
        // variables
        $passwordStrength = $('.passwordStrength');

        if($passwordStrength.length > 0)
        {
            $passwordStrength.each(function()
            {
                // grab id
                var id = $(this).data('id');
                var wrapperId = $(this).attr('id');

                // hide all
                $('#'+ wrapperId +' p.strength').hide();

                // execute function directly
                var classToShow = jsBackend.controls.checkPassword($('#'+ id).val());

                // show
                $('#'+ wrapperId +' p.'+ classToShow).show();

                // bind key press
                $(document).on('keyup', '#'+ id, function()
                {
                    // hide all
                    $('#'+ wrapperId +' p.strength').hide();

                    // execute function directly
                    var classToShow = jsBackend.controls.checkPassword($('#'+ id).val());

                    // show
                    $('#'+ wrapperId +' p.'+ classToShow).show();
                });
            });
        }
    },

    // check a string for password strength
    checkPassword: function(string)
    {
        // init vars
        var score = 0;
        var uniqueChars = [];

        // no chars means no password
        if(string.length == 0) return 'none';

        // less then 4 chars is just a weak password
        if(string.length <= 4) return 'weak';

        // loop chars and add unique chars
        for(var i = 0; i<string.length; i++)
        {
            if($.inArray(string.charAt(i), uniqueChars) == -1) { uniqueChars.push(string.charAt(i)); }
        }

        // less then 3 unique chars is just weak
        if(uniqueChars.length < 3) return 'weak';

        // more then 6 chars is good
        if(string.length >= 6) score++;

        // more then 8 is better
        if(string.length >= 8) score++;

        // upper and lowercase?
        if((string.match(/[a-z]/)) && string.match(/[A-Z]/)) score += 2;

        // number?
        if(string.match(/\d+/)) score++;

        // special char?
        if(string.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) score++;

        // strong password
        if(score >= 4) return 'strong';

        // average
        if(score >= 2) return 'average';

        // fallback
        return 'weak';
    }
}

jsBackend.forms =
{
    // init, something like a constructor
    init: function()
    {
        jsBackend.forms.focusFirstField();
        jsBackend.forms.submitWithLinks();
    },

    // set the focus on the first field
    focusFirstField: function()
    {
        $('form input:visible:not(.noFocus):first').focus();
    },

    // submit with links
    submitWithLinks: function()
    {
        // the html for the button that will replace the input[submit]
        var replaceHTML = '<a class="{class}" href="#{id}"><span>{label}</span></a>';

        // are there any forms that should be submitted with a link?
        if($('form.submitWithLink').length > 0)
        {
            $('form.submitWithLink').each(function()
            {
                // get id
                var formId = $(this).attr('id');
                var dontSubmit = false;

                // validate id
                if(formId != '')
                {
                    // loop every button to be replaced
                    $('form#'+ formId + '.submitWithLink input[type=submit]').each(function()
                    {
                        $(this).after(replaceHTML.replace('{label}', $(this).val()).replace('{id}', $(this).attr('id')).replace('{class}', 'submitButton button ' + $(this).attr('class'))).css({ position:'absolute', top:'-9000px', left: '-9000px' }).attr('tabindex', -1);
                    });

                    // add onclick event for button (button can't have the name submit)
                    $('form#'+ formId + ' a.submitButton').on('click', function(e)
                    {
                        e.preventDefault();

                        // is the button disabled?
                        if($(this).prop('disabled')) return false;
                        else $('form#'+ formId).submit();
                    });

                    // don't submit the form on certain elements
                    $('form#'+ formId + ' .dontSubmit').on('focus', function() { dontSubmit = true; })
                    $('form#'+ formId + ' .dontSubmit').on('blur', function() { dontSubmit = false; })

                    // hijack the submit event
                    $('form#'+ formId).submit(function(e) { return !dontSubmit; });
                }
            });
        }
    }
}

jsBackend.layout =
{
    // init, something like a constructor
    init: function()
    {
        // hovers
        $('.contentTitle').hover(function() { $(this).addClass('hover'); }, function() { $(this).removeClass('hover'); });
        $('.dataGrid td a').hover(function() { $(this).parent().addClass('hover'); }, function() { $(this).parent().removeClass('hover'); });

        jsBackend.layout.showBrowserWarning();
        jsBackend.layout.dataGrid();

        if($('.dataFilter').length > 0) { jsBackend.layout.dataFilter(); }

        // fix last children
        $('.options p:last').addClass('lastChild');
    },

    // data filter layout fixes
    dataFilter: function()
    {
        // add last child and first child for IE
        $('.dataFilter tbody td:first-child').addClass('firstChild');
        $('.dataFilter tbody td:last-child').addClass('lastChild');

        // init var
        var tallest = 0;

        // loop group
        $('.dataFilter tbody .options').each(function()
        {
            // taller?
            if($(this).height() > tallest) tallest = $(this).height();
        });

        // set new height
        $('.dataFilter tbody .options').height(tallest);
    },

    // data grid layout
    dataGrid: function()
    {
        if(jQuery.browser.msie)
        {
            $('.dataGrid tr td:last-child').addClass('lastChild');
            $('.dataGrid tr td:first-child').addClass('firstChild');
        }

        // dynamic striping
        $('.dynamicStriping.dataGrid tr:nth-child(2n)').addClass('even');
        $('.dynamicStriping.dataGrid tr:nth-child(2n+1)').addClass('odd');
    },

    // if the browser isn't supported show a warning
    showBrowserWarning: function()
    {
        var showWarning = false;

        // check firefox
        if(jQuery.browser.mozilla)
        {
            // get version
            var version = parseInt(jQuery.browser.version.substr(0, 3).replace(/\./g, ''));

            // lower than 19?
            if(version < 19) { showWarning = true; }
        }

        // check opera
        if(jQuery.browser.opera)
        {
            // get version
            var version = parseInt(jQuery.browser.version.substr(0, 1));

            // lower than 9?
            if(version < 9) { showWarning = true; }
        }

        // check safari, should be webkit when using 1.4
        if(jQuery.browser.safari)
        {
            // get version
            var version = parseInt(jQuery.browser.version.substr(0, 3));

            // lower than 1.4?
            if(version < 400) { showWarning = true; }
        }

        // check IE
        if(jQuery.browser.msie)
        {
            // get version
            var version = parseInt(jQuery.browser.version.substr(0, 1));

            // lower or equal than 6
            if(version <= 6) { showWarning = true; }
        }

        // show warning if needed
        if(showWarning) { $('#showBrowserWarning').show(); }
    }
}

$(jsBackend.init);

/**
 * Interaction for the installer
 */
var jsInstall =
{
    init: function()
    {
        jsInstall.step2.init();
        jsInstall.step3.init();
        jsInstall.step4.init();
        jsInstall.step6.init();
    }
}

jsInstall.step2 =
{
    init: function()
    {
        jsInstall.step2.toggleLanguageType();
        jsInstall.step2.handleLanguageChanges();
        jsInstall.step2.setInterfaceDefaultLanguage();
    },

    /**
     * Toggles between multiple and single language site
     */
    toggleLanguageType: function()
    {
        if ($('#install_languages_language_type_1').is(':checked')) {
            $('#languages').show();
        }

        if ($('#install_languages_language_type_0').is(':checked')) {
            $('#language').show();
        }

        // multiple languages
        $('#install_languages_language_type_1').on('change', function() {
            if ($('#install_languages_language_type_1').is(':checked')) {
                $('#languages').show();
                $('#language').hide();
                $('#install_languages_default_language option').prop('disabled', true);
                $('#languages input:checked').each(function() { $('#install_languages_default_language option[value='+ $(this).val() +']').removeAttr('disabled'); });
                if($('#install_languages_default_language option[value='+ $('#install_languages_default_language').val() +']').length == 0) $('#install_languages_default_language').val($('#install_languages_default_language option:enabled:first').val());
            }

            jsInstall.step2.setInterfaceDefaultLanguage();
        });

        // single languages
        $('#install_languages_language_type_0').on('change', function() {
            if ($('#install_languages_language_type_0').is(':checked')) {
                $('#languages').hide();
                $('#language').show();
                $('#install_languages_default_language option').removeAttr('disabled');
            }

            jsInstall.step2.setInterfaceDefaultLanguage();
        });
    },

    setInterfaceDefaultLanguage: function()
    {
        // same language as frontend
        if ($('#install_languages_same_interface_language').is(':checked')) {
            // just 1 language selected = only selected frontend language is available as interface language
            if ($('#install_languages_language_type_0').is(':checked')) {
                $('#install_languages_interface_language option').prop('disabled', true);
                $('#install_languages_interface_language option[value='+ $('#install_languages_default_language').val() +']').removeAttr('disabled');
                $('#install_languages_interface_language').val($('#install_languages_interface_language option:enabled:first').val());
            } else if($('#install_languages_language_type_1').is(':checked')) {
                $('#install_languages_interface_language option').prop('disabled', true);
                $('#languages input:checked').each(function() {
                    $('#install_languages_interface_language option[value='+ $(this).val() +']').removeAttr('disabled');
                });

                if ($('#install_languages_interface_language option[value='+ $('#install_languages_interface_language').val() +']').length == 0) {
                    $('#install_languages_interface_language').val($('#install_languages_interface_language option:enabled:first').val());
                }
            }
        } else {
            // different languages than frontend
            $('#install_languages_interface_language option').prop('disabled', true);
            $('#interfaceLanguages input:checked').each(function() { $('#install_languages_interface_language option[value='+ $(this).val() +']').removeAttr('disabled'); });
            if ($('#install_languages_interface_language option[value='+ $('#install_languages_interface_language').val() +']').length == 0) {
                $('#install_languages_interface_language').val($('#install_languages_interface_language option:enabled:first').val());
            }
        }
    },

    handleLanguageChanges: function()
    {
        $('#languages input:checkbox').on('change', function() {
            $('#install_languages_default_language option').prop('disabled', true);
            $('#languages input:checked').each(function() { $('#install_languages_default_language option[value='+ $(this).val() +']').removeAttr('disabled'); });
            if ($('#install_languages_default_language option[value='+ $('#install_languages_default_language').val() +']').length == 0) {
                $('#install_languages_default_language').val($('#install_languages_default_language option:enabled:first').val());
            }

            jsInstall.step2.setInterfaceDefaultLanguage();
        });

        $('#install_languages_default_language').on('change', function() {
            jsInstall.step2.setInterfaceDefaultLanguage();
        });

        // interface language
        if ($('#install_languages_same_interface_language').is(':checked')) {
            $('#interfaceLanguagesExplanation').hide();
            $('#interfaceLanguages').hide();

            jsInstall.step2.setInterfaceDefaultLanguage();
        }

        $('#install_languages_same_interface_language').on('change', function() {
            if ($('#install_languages_same_interface_language').is(':checked')) {
                $('#interfaceLanguagesExplanation').hide();
                $('#interfaceLanguages').hide();
            } else {
                $('#interfaceLanguagesExplanation').show();
                $('#interfaceLanguages').show();
            }

            jsInstall.step2.setInterfaceDefaultLanguage();
        });

        $('#interfaceLanguages input:checkbox').on('change', function() {
            jsInstall.step2.setInterfaceDefaultLanguage();
        });
    }
}

jsInstall.step3 =
{
    init: function()
    {
        jsInstall.step3.toggleDebugEmail();
    },

    toggleDebugEmail: function()
    {
        $('#debugEmailHolder').hide();

        if ($('#install_modules_different_debug_email').is(':checked')) {
            $('#debugEmailHolder').show();
        }

        // multiple languages
        $('#install_modules_different_debug_email').on('change', function() {
            if ($('#install_modules_different_debug_email').is(':checked')) {
                $('#debugEmailHolder').show();
                $('#install_modules_debug_email').focus();
            } else {
                $('#debugEmailHolder').hide();
            }
        });
    }
}

jsInstall.step4 =
{
    init: function()
    {
        $('#javascriptDisabled').remove();
        $('#installerButton').removeAttr('disabled');
    }
}

jsInstall.step6 =
{
    init: function()
    {
        $('#showPassword').on('change', function(e)
        {
            e.preventDefault();

            // show password
            if($(this).is(':checked'))
            {
                $('#plainPassword').show();
                $('#fakePassword').hide();
            }
            else
            {
                $('#plainPassword').hide();
                $('#fakePassword').show();
            }
        });
    }
}

$(jsInstall.init);
