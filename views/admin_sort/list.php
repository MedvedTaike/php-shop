<?php require(ROOT.'/views/pattern/header_sort.php'); ?>
<section>
    <div class="container">
        <div class="jumbotron">
            <ul class="list-group sortable">
                <?php foreach($item as $product): ?>
                <li class="list-group-item" id="item-<?php echo $product['id']; ?>">
                    <?php echo ' №'.$product['sort_order'].' / '. $product['name']; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?php require(ROOT.'/views/pattern/footer_sort.php'); ?>
<script>
    $(function(){
        $('.sortable').sortable();
        $('.save').on('click', function(e){
            e.preventDefault();
            var sortable_data = $('.sortable').sortable('serialize');
            $.ajax({
                url:"/admin/ajax",
                method:"POST",
                data: sortable_data ,
                success:function(){
                    location.reload();
                }
            });
        });
    });
</script>