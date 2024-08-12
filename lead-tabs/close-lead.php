<div id="c_lead" class="tab-pane fade">
      <h3>Close Lead</h3>
      <p>
      	Click Here for Successfull Lead: 
        <a href="lead_details.php?closeLead=successfull&leadId=<?php echo $cm->encodeData($leadId) ?>" 
        onclick="return confirm('Are you sure You want to Lead Successfull');" style="text-decoration:underline; color:#0054a6">Cick Here</a><br>
        Click Here for UnSuccessfull Lead: 
        <a onClick="close_un_suc()" style="text-decoration:underline; color:#0054a6">Cick Here</a>
       </p>
    </div>