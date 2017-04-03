<?php include('includes/header.php');?>
<?php include('includes/login/auth.php');?>
<?php include('includes/create/main.php');?>

<!-- Validation -->
<script type="text/javascript" src="<?php echo get_app_info('path');?>/js/validate.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#list-form").validate({
			rules: {
				list_name: {
					required: true	
				}
			},
			messages: {
				list_name: "<?php echo addslashes(_('List name is required'));?>"
			}
		});
	});
</script>

<div class="row-fluid">
    <div class="span2">
        <?php include('includes/sidebar.php');?>
    </div> 
    <div class="span10">
    	<div>
	    	<p class="lead"><?php echo get_app_data('app_name');?></p>
    	</div>
    	<h2><?php echo _('Create a Segmented List based on Geo');?></h2><br/>
	    <form action="<?php echo get_app_info('path')?>/includes/subscribers/geo-add.php" method="POST" accept-charset="utf-8" class="form-vertical" enctype="multipart/form-data" id="list-form">
	    	
	   
	    	<div class="control-group">
		    	<div class="controls">
		    	<label class="control-label" for="list_name"><?php echo _('Segmented List name');?></label>
	              <input type="text" class="input-xlarge" id="list_name" name="list_name" placeholder="<?php echo _('The name of your new geo segmented list');?>">
<label class="control-label" for="list_name"><?php echo _('Parent List');?></label>
<?php 
			  	$q = 'SELECT id, name FROM lists WHERE app = '.get_app_info('app').' AND userID = '.get_app_info('main_userID').' ORDER BY name ASC';
$r = mysqli_query($mysqli, $q);
			  	if ($r && mysqli_num_rows($r) > 0)
			  	{
			  	    while($row = mysqli_fetch_array($r))
			  	    {
			  			$id = $row['id'];
			  			$name = stripslashes($row['name']);
                                                echo '<input type="radio" name="parent_list_id" value="'.$id.'"> '.$name.'<br>';
                                                }
                                }
?>
<br>

	            </div>
	        </div>
              
	        <label>Main Zip Code</label>
	        <input class="input-mini" type="text" name="zip_code" placeholder="Zip Code" required="required" />
	        <label>Radius (in miles)</label>
	        <input class="input-mini" type="number" min="0" name="distance" placeholder="Distance" required="required" />

	        
	        <input type="hidden" name="app" value="<?php echo get_app_info('app');?>">
	        <br>
	        <button type="submit" class="btn btn-inverse"><i class="icon icon-plus"></i> <?php echo _('Create');?></button>
	    </form>
    </div>   
</div>
<?php include('includes/footer.php');?>
