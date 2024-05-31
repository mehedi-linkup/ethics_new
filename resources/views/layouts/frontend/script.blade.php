<script src="{{asset('frontend')}}/assets/js/modernmag-plugins.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/popper.js"></script>
<script src="{{asset('frontend')}}/assets/js/bootstrap.min.js"></script>
<script src="{{asset('frontend')}}/assets/http://maps.google.com/maps/api/js?key=AIzaSyCiqrIen8rWQrvJsu-7f4rOta0fmI5r2SI&amp;sensor=false&amp;language=en"></script>
<script src="{{asset('frontend')}}/assets/js/gmap3.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/script.js"></script>
<!-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addCart(id, wishlist = null) {
        $.ajax({
            url: location.origin + "/addcart",
            method: "POST",
            dataType: "JSON",
            data: {
                id: id,
                quantity: 1
            },
            beforeSend: () => {
                $(".checkout-scroll").html("")
                $(".cartImage").removeClass("d-none")
            },
            success: res => {
                $.notify(res.msg, "success");
                $.each(res.content, (index, value) => {
                    let row = `
                        <li class="checkout-cart-list">
                            <div class="checkout-img">
                                <img class="product-image" src="${value.options.image != null ? location.origin+"/"+value.options.image: location.origin+'/no-product-image.jpg'}" alt="img" />
                                <span class="product-quantity">${value.qty}x</span>
                            </div>
                            <div class="checkout-block">
                                <a class="product-name" href="{{route('product')}}">${value.name}</a>
                                <span class="product-price">৳ ${value.price}</span>
                                <a class="remove-cart" row-id="${value.rowId}" onclick="removeCart(event)">
                                    x
                                </a>
                            </div>
                        </li>
                    `;
                    $(".checkout-scroll").append(row)
                })

                // total calculate
                $(".subTotal label").text(res.subtotal)
                $(".Total label").text(res.subtotal)
                $(".cartTotalCount").text(res.cartCount)

                if (wishlist != null) {
                    $.ajax({
                        url: location.origin + "/deletewishlist",
                        method: "POST",
                        data: {
                            product_id: id
                        },
                        success: res => {
                            $(".wishlist-" + id).remove();
                            if (res.content == 0) {
                                let row = `
                            <tr>
                                <td colspan="6" class="text-center">
                                    Product Not Found
                                </td>
                            </tr>
                            `;
                                $("#wishlistTable").find("table tbody").html(row)
                            }

                        }
                    })
                }
            },
            complete: () => {
                setTimeout(() => {
                    $(".cartImage").addClass("d-none")
                }, 500)
            }
        })
    }

    function removeCart(event) {
        event.preventDefault();

        $.ajax({
            url: location.origin + "/removecart",
            method: "POST",
            dataType: "JSON",
            data: {
                rowId: event.target.getAttribute("row-id")
            },
            success: res => {
                $.notify(res.msg, "success");
                event.target.offsetParent.parentElement.remove()
                $("." + event.target.getAttribute("row-id")).remove()
                //calculate total
                $(".subTotal label").text(res.subtotal)
                $(".Total label").text(res.subtotal)
                $(".cartTotalCount").text(res.cartCount)

                // cart total
                $(".cartTotal").text(res.subtotal)
                $(".cartSubTotal").text(res.subtotal)

                if (res.cartCount == 0) {
                    let row = `
                        <li class="checkout-cart-list">
                            <div class="p-4 w-100 text-center">
                                <img src="${location.origin+"/emptycart.png"}" width="150">
                            </div>
                        </li>
                    `;
                    $(".checkout-scroll").html(row);

                    let row1 = `
                            <tr>
                                <td colspan="7" class="text-center">
                                    <img src="${location.origin+"/emptycart.png"}" width="150">
                                </td>
                            </tr>                          
                        `;

                    $(".cartTable tbody").html(row1)
                }
            }
        })
    }

    // add wishlist
    function addWishlist(id) {
        $.ajax({
            url: location.origin + "/addwishlist",
            method: "POST",
            data: {
                id: id
            },
            success: res => {
                if (res.login) {
                    $.notify(res.login, "success")
                    setTimeout(() => {
                        location.href = "/login"
                    }, 500)
                } else {
                    $.notify(res.msg, res.status)
                }
            }
        })
    }
</script> -->
@stack('webjs')