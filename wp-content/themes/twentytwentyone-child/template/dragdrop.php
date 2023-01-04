<?php
/*
Template Name: drag&drop
Template Post Type: post, page, my-post-type;
*/
get_header();
?>
<div class="row widgets">
    <div class="text-center col-md-5" id="container1">
        <h2>A</h2>
        <?php $arr=array(1, 2, 3, 4,5,6);
         $count = 0;
         foreach ($subCat_of_parent as $subcat) 
         {
              echo ('<div itemid="itm-' . $subcat . '" class="child" id="itm-1">' . $subcat . '</div>');
             $count++;
            }
     ?>
        <!--<div itemid="itm-1'" class="child" id="itm-1">Item 1</div>
        <div itemid="itm-2" class="child" id="itm-2">Item 2</div>
        <div itemid="itm-3" class="child" id="itm-3">Item 3</div>
        <div itemid="itm-4" class="child" id="itm-4">Item 4</div>
        <div itemid="itm-5" class="child" id="itm-5">Item 5</div>
        <div itemid="itm-6" class="child" id="itm-6">Item 6</div>
        <div itemid="itm-7" class="child" id="itm-7">Item 7</div>
        <div itemid="itm-8" class="child" id="itm-8">Item 8</div>
        <div itemid="itm-9" class="child" id="itm-9">Item 9</div>
        <div itemid="itm-10" class="child" id="itm-10">Item 10</div>-->
    </div>
    <div class="text-center col-md-5" id="container2">
        <h2>B</h2>
    </div>
</div>

<?php
get_footer(); ?>