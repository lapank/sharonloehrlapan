jQuery(document).ready(function(){
  /* Add first gallery click */
  jQuery(document).on("click", "#bwg_add_first_gallery", function() {
    bwg_add_first_gallery(this);
  });

  /* Step change click which is worked from "Got it" or "Skip sign up" */
  jQuery(document).on("click", '.bwg_onboarding_step_change', function(event) {
    bwg_onboarding_step_change(this, '');
  });

  /* Sign up click */
  jQuery(document).on("click", '.bwg_onboarding_signup_button', function(event) {
    bwg_install_booster_plugin(this);
  });
});

/* Create first gallery ajax action */
function bwg_add_first_gallery() {
  var bwg_error = jQuery(".bwg_error");
  bwg_error.addClass("bwg_hidden");
  var name = jQuery("#name").val();
  if( name == '' ) {
    bwg_error.removeClass("bwg_hidden").text(onboarding.required_title_msg);
    return;
  }
  jQuery("#bwg_add_first_gallery").empty().append("<span></span>").addClass("bwg_onboarding_button_loading");
  var bwg_nonce = jQuery("#bwg_nonce").val();
  jQuery.ajax( {
    url: ajaxurl,
    type: "POST",
    data: {
      action: "onboarding_ajax",
      task: "add_first_gallery",
      name: name,
      bwg_nonce: bwg_nonce
    },
    success: function (response) {
      if( response.success ){
        window.location.href = onboarding.edit_page+'&current_id='+response.data.id;
      }
    },
    error: function () {
      window.location.href = onboarding.gallery_list_page;
    },
    complete: function () {
      jQuery("#bwg_add_first_gallery").removeClass("bwg_onboarding_button_loading").text(onboarding.proceed);
    },
  });
}

/* Step change */
function bwg_onboarding_step_change(that, email) {
  var onboarding_step = jQuery(that).data("onboarding_step");
  jQuery(".bwg_onboarding_button.bwg_onboarding_step_change").empty().append("<span></span>").addClass("bwg_onboarding_button_loading");
  jQuery.ajax( {
    url: ajaxurl,
    type: "POST",
    data: {
      action: "onboarding_ajax",
      task: "onboarding_step_change",
      email: email,
      onboarding_step: onboarding_step,
      bwg_nonce: onboarding.bwg_nonce
    },
    success: function (response) {
      jQuery(document).find(".bwg_onboarding_container").replaceWith(response);
    },
    error: function() {
      window.location.href = onboarding.onboarding_page;
    },
  });
}

/**
 * Install/activate the plugin.
 *
 * @param that object
 */
function bwg_install_booster_plugin( that ) {
  var bwg_error = jQuery(".bwg_error");
  bwg_error.addClass("bwg_hidden");
  var email = jQuery("#bwg_signup_email").val();

  if (email === '') {
    bwg_error.text(onboarding.empty_email).removeClass("bwg_hidden");
    return;
  }
  if (!bwg_isEmail(email)) {
    bwg_error.text(onboarding.wrong_email).removeClass("bwg_hidden");
    return;
  }

  if ( jQuery(that).hasClass("bwg-disable-link") ) {
    return;
  }

  jQuery(".bwg_onboarding_button").empty().append("<span></span>").addClass("bwg_onboarding_button_loading");

  jQuery.ajax( {
    url: ajaxurl,
    type: "POST",
    dataType: "text",
    data: {
      action: "twb",
      task: "install_booster",
      speed_ajax_nonce: onboarding.speed_ajax_nonce
    },
    success: function() {
      bwg_signup_dashboard(email);
    },
    error: function() {
      jQuery(that).removeClass('twb-disable-link');
      jQuery(".bwg_error").text(onboarding.something_wrong).removeClass("bwg_hidden");
      bwg_onboarding_button.removeClass("bwg_onboarding_button_loading").text(onboarding.signup);
    },
  });
}

/**
 * Sign up to dashboard ajax action.
 *
 * @param email string
*/
function bwg_signup_dashboard(email) {
  var bwg_onboarding_button = jQuery(".bwg_onboarding_button");
  var finished = 0;
  jQuery.ajax( {
    url: ajaxurl,
    type: "POST",
    dataType: "text",
    data: {
      action: "twb",
      task: "sign_up_dashboard",
      twb_email: email,
      parent_slug: "onboarding_bwg",
      is_plugin: 1,
      speed_ajax_nonce: onboarding.speed_ajax_nonce
    },
    success: function (result) {
      if ( !bwg_isValidJSONString(result) ) {
        /* booster activation redirect to booster page which make broken ajax response so send 2-nd time */
        if ( result.indexOf('two-container') > -1 ) {
          bwg_signup_dashboard(email);
          return;
        }
        bwg_onboarding_button.removeClass('twb-disable-link');
        jQuery(".bwg_error").text(onboarding.something_wrong).removeClass("bwg_hidden");
        return;
      }
      finished = 1;
      var data = JSON.parse(result);
      if ( data['status'] === 'success' ) {
        bwg_onboarding_step_change(jQuery(".bwg_onboarding_button"), email);
      }
      else {
        jQuery(".bwg_error").text(onboarding.something_wrong).removeClass("bwg_hidden");
        bwg_onboarding_button.removeClass('twb-disable-link');
        return;
      }
    },
    error: function (xhr) {
      jQuery(".bwg_error").text(onboarding.something_wrong).removeClass("bwg_hidden");
    },
    complete: function() {
      if ( finished ) {
        bwg_onboarding_button.removeClass('twb-disable-link');
        bwg_onboarding_button.removeClass("bwg_onboarding_button_loading").text(onboarding.signup);
      }
    }
  });
}

/**
 * Check if value is email
 *
 * @param email string
 *
 * @return bool
 */
function bwg_isEmail( email ) {
  var EmailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return EmailRegex.test(email);
}

/**
 * Check if data is valid json
 *
 * @param str string
 *
 * @return bool
 */
function bwg_isValidJSONString( str ) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}

