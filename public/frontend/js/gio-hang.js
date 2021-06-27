$(document).ready(function () {
    CartController.init();
});

var CartController = {
    init: function () {
        CartController.decreaseQtyUniy();
    },

    // decrease qty product a unit
    decreaseQtyUniy: function (item) {

        var parentNode = item.parentNode; // object

        nodeInputQty = parentNode.querySelector('input[name="qty"]');

        minQty = nodeInputQty.min ? nodeInputQty.min : 1;

        qty = parseInt(nodeInputQty.value) - 1;

        if (qty >= minQty) {
            nodeInputQty.value = qty;
        }

        // Updating cart
        nodeInputProductId = parentNode.querySelector('input[name="productId"]');
        productId = nodeInputProductId.value;

        CartController.updateCart(productId, qty);
    },


}

// increase qty product a unit
function increaseQtyUnit(item) {

    var parentNode = item.parentNode; // object

    nodeInputQty = parentNode.querySelector('input[name="qty"]');

    maxQty = nodeInputQty.max ? nodeInputQty.max : 1000;

    qty  = parseInt(nodeInputQty.value) + 1;

    if (qty <= maxQty)
    {
        nodeInputQty.value = qty;
    }

    // Updating cart
    nodeInputProductId = parentNode.querySelector('input[name="productId"]');
    productId = nodeInputProductId.value;

    updateCart(productId, qty);
}

// Update cart using ajax
function updateCart(productId, qty) {
    data = {
        "_token"    :   "{{ csrf_token() }}",
        "productID" : productId,
        'qty'       : qty
    };

    {{--$.ajax({--}}
        {{--type    : 'post',--}}
        {{--url     : "{{ route('updateCart') }}",--}}
        {{--data    : data,--}}
        {{--dataType: 'json',--}}
        {{--success : function (response) {--}}
            {{--console.log(JSON.stringify(response));--}}
            {{--location.reload();--}}
            {{--},--}}
        {{--error   : function (xhr,status,error) {--}}
            {{--console.log('Co loi khi gui ajax');--}}
            {{--console.log(xhr);--}}
            {{--console.log(status);--}}
            {{--console.log(error);--}}
            {{--}--}}
        {{--});--}}
}
};