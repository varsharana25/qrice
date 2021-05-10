<script>
$(document).ready(function(){
	$('#category_id').on("change",function(){	
	var category_id=$(this).val();
	$.ajax({
			type: "POST",
			url: "<?php echo BASE_URL;?>subcategories/get_subcategory/",
			data: 'category='+category_id,
			dataType: 'html',
			success: function (data) {
				if(data!='No') {	
				$('#subcategory_id').html(data);
				/*$('#subcategory_id').select2('destroy');
				$('#subcategory_id').select2();*/
			  }
			}		
		});
	});
});

</script>
