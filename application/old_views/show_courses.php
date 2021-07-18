<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Course Title</th>
            <th>Category</th>
            <th>description</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach ($data as $row) {
                
        echo " <tr>
            <td><input class='checked_cat_type' type='checkbox' id='".$edit_add."_".$row["course_id"]."' value=".$row["course_id"]."><label for='".$edit_add."_".$row["course_id"]."'>".$row["course_title"]."</label></td>
            <td>".$row['value']."</td>
            <td>".$row['course_description']."</td>";
    } ?>
    </tbody>
    <div id='course_value' hidden></div>
</table>



<script>
    $('.checked_cat_type').on('change',function(e){
        e.preventDefault();
        var cat_id_value = "";  
        $("input:checkbox[class=checked_cat_type]:checked").each(function () {
            if(cat_id_value == ""){
                cat_id_value =$(this).val();
            }else{
                cat_id_value = cat_id_value + ',' + ($(this).val());
            }
        });
        if(cat_id_value == ''){
          alert('please select any 1 category');
          return false;
        }
        console.log(cat_id_value);
        $('#course_value').val(cat_id_value);
    })
</script>