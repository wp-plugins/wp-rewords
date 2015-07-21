<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuval
 * Date: 7/8/15
 * Time: 10:54 AM
 */

 $options = $this->options;
 $campaigns = $options['campaigns'];
 $permalink = get_permalink();
?>


 <div id="wp_rewords_campaigns">
     <table class="form-table">
         <tbody>
         <tr class="wp_rewords_settings">
             <th scope="row" >
                 <label>Campaign:</label>
             </th>
             <td>
                <span id="wp_rewords_campaigns_select"></span>
             </td>
             <td class="wp_rewords_submitadd">
                 <button id="wp_rewords_add_campaign" class="button-primary">Add New</button>
             </td>
         </tr>
         </tbody>
     </table>
 </div>
<hr />
 <div class="wp_rewords_campaign_content">
     <h2>Add New Campaign</h2>
     <div id="wp_rewords_required" class="wp_rewords_notice-error">
         <div class="error-alert">
             <p>All fields are required</p>
         </div>
     </div>

     <table class="form-table">
         <tbody>
         <tr class="wp_rewords_settings">
             <th scope="row" >
                 <label>Campaign Name:</label>
             </th>
             <td>
                 <input class="wp_rewords_name" type="text" name="wp_rewords_name" value=""/>
                 <div>Campaign name for internal use</div>

             </td>
         </tr>
         <tr class="wp_rewords_settings">
             <th scope="row" >
                 <label>Campaign Page Title:</label>
             </th>
             <td>
                 <input class="wp_rewords_title" type="text" name="wp_rewords_title" value=""/>
                 <div>Title of the Page</div>

             </td>
         </tr>
         <tr class="wp_rewords_settings">
             <th scope="row" >
                 <label>Campaign URL:</label>
             </th>
             <td>
                 <input class="wp_rewords_url" type="text" name="wp_rewords_url" value=""/>
                 <div>Any campaign URL that will activate the title <br></div>
             </td>
         </tr>
         </tbody>
     </table>

     <div class="wp_rewords_submitbox">
         <span id="cancel-action">
             <button id="wp_rewords_cancel_campaign" class="button-secondary">Cancel</button>
         </span>
         <span id="publishing-action">
             <button id="wp_rewords_create_campaign" class="button-primary">Create</button>
         </span>
     </div>
 </div>

<div id="wp_rewords_edit_campaign_content"></div>


<script id="template" type="x-tmpl-mustache">
    <select id="wp_rewords_campaign" name="wp_rewords_campaign">
            <option value="">Default - Default Values</option>
            {{#campaigns}}
                <option data-id="{{id}}" value="">{{name}}</option>
            {{/campaigns}}
    </select>
</script>


<script id="wp_rewords_edit_campaign" type="x-tmpl-mustache">
     <div id="wp_rewords_required" class="wp_rewords_notice-error">
         <div class="error-alert">
             <p>All fields are required</p>
         </div>
     </div>

      <table class="form-table">
        <tbody>
           <tr class="wp_rewords_settings">
                <th scope="row" >
                    <label>Campaign Name:</label>
                </th>
                <td>
                    <input class="wp_rewords_edit_name" type="text" name="wp_rewords_name" value="{{name}}"/>
                    <div>Campaign name for internal use</div>
                </td>
           </tr>
           <tr class="wp_rewords_settings">
                <th scope="row" >
                    <label>Campaign Page Title:</label>
                </th>
                <td>
                    <input class="wp_rewords_edit_title" type="text" name="wp_rewords_title" value="{{title}}"/>
                    <div>Title of the Page</div>
                </td>
           </tr>
           <tr class="wp_rewords_settings">
                <th scope="row" >
                    <label>Campaign URL:</label>
                </th>
                <td>
                    <input class="wp_rewords_edit_url" type="text" name="wp_rewords_url" value="{{url}}"/>
                    <div>Any campaign URL that will activate the title <br></div>
                </td>
           </tr>
        </tbody>
      </table>


    <div class="wp_rewords_submitbox">
        <div id="delete-action">
            <a id="wp_rewords_delete_campaign" data-id="{{id}}" class="submitdelete deletion" href="">Move to Trash</a>
        </div>
        <div id="publishing-action">
            <button id="wp_rewords_save_campaign" class="button-primary" data-id="{{id}}">Save</button>
        </div>
    </div>
</script>