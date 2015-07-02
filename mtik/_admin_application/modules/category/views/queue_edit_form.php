<style type="text/css">
<!--
    fieldset { border:none; width:320px;}
    legend { font-size:15px; margin:0px; padding:0px 0px; color:#555555; font-weight:bold;}
    label { display:block; margin:0px 0 5px;}
    fieldset{
    width: 90%;
    text-align: left;
    
    }
    .prev { float:left;}
    .next { float:right;}
    #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px; border: 1px solid #dddddd; border-top-left-radius:3px; border-top-right-radius:3px; width: 218px; background: #F3F3F5; border-left: none; border-bottom: none;}
    #steps li {font-size:18px; float:left; padding-left:10px; padding-right:10px; padding-top: 5px; color:#b0b1b3; background: #F3F3F5; border-left: 1px solid #dddddd;}
    #steps li span {font-size:13px; margin-top: -4px; color: #DD4814; display:block;}
    #steps li.current { color:#000; background: #DDDDDD;  }
    #makeWizard { background-color:#b0232a; color:#fff; padding:5px 10px; text-decoration:none; font-size:18px;}
    #makeWizard:hover { background-color:#000;}
    #inner_div_my{
    border: 1px solid #DDDDDD;
    border-radius:3px;
    }
    .field_inside{
        min-height: 300px;
    }
    b { padding:0 0 5px 0; }


    

-->
</style>
<?php
	//print_r($queue_detail);
    
     //print_r($limits);
     //echo $queue_detail['parent_queue_id'];
     
     
     
     //print_r($parent);
     //echo "<hr>";
     //print_r($queues);
?>
<div>

<div id="waiting">
<div style="text-align: left; margin-left: 20px;">
<form id="SignupForm"  method="post" action="<?php echo base_url(); ?>category/edit_queue_operation">

<div id="inner_div_my" >

<center>
    <fieldset>
        <div class="field_inside">
            
            <label for="CompanyName"><strong>Queue Name</strong></label>
            <input   type="text" value="<?php echo $queue_detail['name'] ?>" disabled="true"  />
            <input  id="name" name="name" type="hidden" value="<?php echo $queue_detail['name'] ?>"   /><br />
            <span style="color: #DD4814; font-weight: ;"><strong>Queue Name:</strong> Spaces and Special Characters are not Allowed!</span>
            
            <label for="CompanyName"><strong>Target Address</strong></label>
            <?php
            $exp_ip = explode(',',$queue_detail['target_address']);
            $count_ip = 0;
	        foreach($exp_ip as $ips){
	           $count_ip = $count_ip+1;
	        }
            if($count_ip=='1'){
            ?>
            <input type="text"  size="20"  value="<?php echo $queue_detail['target_address']; ?>" disabled="true" />
            <?php
	           }
               else{
                for($i=0; $i<$count_ip; $i++){
                    ?>
                        <input type="text"  size="20"  value="<?php echo $exp_ip[$i]; ?>" disabled="true" /><br />
                    <?php
                }
               }
            ?>
            </span>
            <br />        
            
            <input type="hidden" value="<?php echo $cat_id; ?>" name="cat_id" />
            <span style="font-size: 14px;">Target Upload</span><span style="margin-left: 132px; font-size: 14px;">Target Download</span><br />
            <select name="upload_limit" >
                <?php
                  
                 foreach($limits as $l){
                    //echo $result
                    ?>
                  <option value="<?php echo $l['limits'];?>" <?php echo ($queue_detail['rx_max_limit']==$l['limits']?'selected':''); ?>><?php echo $l['title'];?></option>
                  <?php
                        }
                  ?>
            </select>
            <select name="download_limit" >
                <?php
                  
                 foreach($limits as $l){
                    //echo $result
                    ?>
                  <option value="<?php echo $l['limits'];?>" <?php echo ($queue_detail['tx_max_limit']==$l['limits']?'selected':''); ?>><?php echo $l['title'];?></option>
                  <?php
                        }
                  ?>
            </select>bits/s
            
      
            
            <label for="CompanyName"><strong>Parent</strong></label>
            <select id="parent"  disabled="true" >
                
                <?php
                if($queue_detail['parent_queue_id']=='0'){
                    ?>
                    <option value="0" selected="" >Select Parent</option>   
                    <?php
                    foreach($queues as $q11){
                ?>
                     <option value="<?php echo $q11['name'];?>" ><?php echo $q11['name'];?></option>   
                <?php 
                    }
                }
                else{
                    $parent = $this->category_model->get_queue_by_qid($queue_detail['parent_queue_id']);
               
	               foreach($queues as $q){
	                   
                ?>
                <option value="<?php echo $q['name'];?>" <?php echo ($parent[0]['name']==$q['name']?'selected':'true'); ?>><?php echo $q['name'];?></option>
                <?php
	               }
                    }
                ?>
            </select>
            <input type="hidden" name="parent"  value="<?php echo $queue_detail['parent_queue_id']; ?>"/>
        </div>
    </fieldset>
    
    <p>
        
        <div class="form-actions" style="text-align: left;">
            <button  type="submit" class="btn btn-primary">Edit Queue</button>
            
        </div>
    </p>
</center>
</div>
</form>
</div>
</div>