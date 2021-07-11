<?php require(ROOT.'/views/pattern/header_sort.php'); ?>
<section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 sortable">
                    <?php foreach($item as $product): ?>
                    <div class="col-sm-3" id="item-<?php echo $product['id']; ?>">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <img src="/images/<?php echo $product['id']; ?>.jpg" />
                            </div>
                        </div>
                    </div>
                   <?php endforeach; ?>
                </div>
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