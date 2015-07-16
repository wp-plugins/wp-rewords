(function ($) {
  'use strict';

  /**
   * All of the code for your admin-specific JavaScript source
   * should reside in this file.
   *
   * Note that this assume you're going to use jQuery, so it prepares
   * the $ function reference to be used within the scope of this
   * function.
   *
   * From here, you're able to define handlers for when the DOM is
   * ready:
   *
   * $(function() {
   *
   * });
   *
   * Or when the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and so on.
   *
   * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
   * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
   * be doing this, we should try to minimize doing that in our own work.
   */
  function renderSelect(campaignList) {
    var template = $('#template').html();
    Mustache.parse(template);   // optional, speeds up future uses
    var rendered = Mustache.render(template, campaignList);
    $('#wp_rewords_campaigns_select').html(rendered);
  }

  function getCampaignById(id, campaigns) {
    for (var i=0; i < campaigns.length; i++) {
      if (campaigns[i].id == id) {
        return campaigns[i];
      }
    }
    return "";
  }

  function getLatestCampaignId(campaigns) {
    var id = 0;
    for (var i=0; i < campaigns.length; i++) {
      if (campaigns[i].id > id) {
        id = campaigns[i].id;
      }
    }
    return id;
  }

  function displayLatestOrAdd(campaigns) {
    if (campaigns.length === 0) {
      $(".wp_rewords_campaign_content").show();
      $(".wp_rewords_campaign_content input").attr("value", "");
    } else {
      var id = getLatestCampaignId(campaigns);
      $("#wp_rewords_campaign option[data-id='" + id + "']").attr("selected", "selected");
      $("#wp_rewords_campaign").change();
    }
  }

  $(document).ready(function () {
    var campaigns = {};
    var postData = {
      'action': 'wp_rewords_get_campaigns',
      'pageId': $('#post_ID').attr("value")
    };

    $.post(ajaxurl, postData, function (response) {
      campaigns.campaigns = response;
      renderSelect(campaigns);
      displayLatestOrAdd(campaigns.campaigns);
    });

    $('#wp_rewords_add_campaign').on("click", function (e) {
      e.preventDefault();
      $(".wp_rewords_notice-error").hide();
      $(".wp_rewords_invalid").removeClass("wp_rewords_invalid");

      $(".wp_rewords_campaign_content").show();
      $(".wp_rewords_campaign_content input").attr("value", "");
      $('#wp_rewords_edit_campaign_content').hide();
      $('#wp_rewords_edit_campaign_content').html("");
    });

    $('#wp_rewords_create_campaign').on("click", function (e) {
      e.preventDefault();
      $(".wp_rewords_notice-error").hide();
      $(".wp_rewords_invalid").removeClass("wp_rewords_invalid");

      var valid = true;
      var name = $('.wp_rewords_name').attr("value");
      if (name === undefined || name === "") {
        $('.wp_rewords_name').addClass("wp_rewords_invalid");
        valid = false;
      }
      var title = $('.wp_rewords_title').attr("value");
      if (title === undefined || title === "") {
        $('.wp_rewords_title').addClass("wp_rewords_invalid");
        valid = false;
      }
      var url = $('.wp_rewords_url').attr("value");
      if (url === undefined || url === "") {
        $('.wp_rewords_url').addClass("wp_rewords_invalid");
        valid = false;
      }

      if (valid) {
        var data = {
          'action': 'wp_rewords_create_campaign',
          'pageId': $('#post_ID').attr("value"),
          'name': name,
          'title': title,
          'url': url
        };

        $.post(ajaxurl, data, function (response) {
          campaigns.campaigns = response;
          renderSelect(campaigns);
          var newElementIndex = getLatestCampaignId(campaigns.campaigns);
          $("#wp_rewords_campaign option").removeAttr("selected");
          $("#wp_rewords_campaign option[data-id='" + newElementIndex + "']").attr("selected", "selected");
          $("#wp_rewords_campaign").change();
          $(".wp_rewords_campaign_content input").attr("value", "");
          $(".wp_rewords_campaign_content").hide();
        });
      } else {
        $(".wp_rewords_notice-error").show();
      }
    });


    $("#wp_rewords_campaigns").on("change", "#wp_rewords_campaign" ,function () {
      $(".wp_rewords_campaign_content input").attr("value", "");
      $(".wp_rewords_campaign_content").hide();
      $(".wp_rewords_notice-error").hide();
      $(".wp_rewords_invalid").removeClass("wp_rewords_invalid");

      var campaignIndex = $("#wp_rewords_campaign option:selected").attr("data-id");
      if (campaignIndex !== undefined) {
        var campaign = getCampaignById(campaignIndex, campaigns.campaigns);
        if (campaign !== "") {
          $('#wp_rewords_edit_campaign_content').show();
          var template = $('#wp_rewords_edit_campaign').html();
          Mustache.parse(template);   // optional, speeds up future uses
          var rendered = Mustache.render(template, campaign);
          $('#wp_rewords_edit_campaign_content').html(rendered);
        }
      } else {
        $('#wp_rewords_edit_campaign_content').hide();
        $('#wp_rewords_edit_campaign_content').html("");
        $(".wp_rewords_campaign_content input").attr("value", "");
        $(".wp_rewords_campaign_content").show();
      }

    });

    $("#wp_rewords_edit_campaign_content").on("click", "#wp_rewords_save_campaign" ,function (e) {
      e.preventDefault();
      $(".wp_rewords_notice-error").hide();
      $(".wp_rewords_invalid").removeClass("wp_rewords_invalid");

      var campaignId = $(this).attr("data-id");
      if (campaignId !== undefined) {
        var valid = true;
        var name = $('.wp_rewords_edit_name').attr("value");
        if (name === undefined || name === "") {
          $('.wp_rewords_edit_name').addClass("wp_rewords_invalid");
          valid = false;
        }
        var title = $('.wp_rewords_edit_title').attr("value");
        if (title === undefined || title === "") {
          $('.wp_rewords_edit_title').addClass("wp_rewords_invalid");
          valid = false;
        }
        var url = $('.wp_rewords_edit_url').attr("value");
        if (url === undefined || url === "") {
          $('.wp_rewords_edit_url').addClass("wp_rewords_invalid");
          valid = false;
        }

        if (valid) {
          var data = {
            'action': 'wp_rewords_save_campaign',
            'pageId': $('#post_ID').attr("value"),
            'index': campaignId,
            'name': name,
            'title': title,
            'url': url
          };

          $.post(ajaxurl, data, function (response) {
            campaigns.campaigns = response;
            renderSelect(campaigns);
            $("#wp_rewords_campaign option").removeAttr("selected");
            $("#wp_rewords_campaign option[data-id='" + campaignId + "']").attr("selected", "selected");
          });
        } else {
          $(".wp_rewords_notice-error").show();
        }
      }
    });

    $("#wp_rewords_edit_campaign_content").on("click", "#wp_rewords_close_campaign" ,function (e) {
      e.preventDefault();
      $('#wp_rewords_edit_campaign_content').hide();
      $('#wp_rewords_edit_campaign_content').html("");
    });

    $("#wp_rewords_edit_campaign_content").on("click", "#wp_rewords_delete_campaign" ,function (e) {
      e.preventDefault();
      var campaignId = $(this).attr("data-id");
      if (campaignId !== undefined) {
        var data = {
          'action': 'wp_rewords_delete_campaign',
          'pageId': $('#post_ID').attr("value"),
          'index': campaignId
        };

        $.post(ajaxurl, data, function (response) {
          campaigns.campaigns = response;
          renderSelect(campaigns);
          displayLatestOrAdd(campaigns.campaigns);
        });
      }

      $('#wp_rewords_edit_campaign_content').hide();
      $('#wp_rewords_edit_campaign_content').html("");
    });


  });

})(jQuery);
