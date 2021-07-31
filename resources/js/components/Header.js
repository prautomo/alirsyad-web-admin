import React from 'react';
import ReactDOM from 'react-dom';
import useCart from '../store/useCart'

function Header() {
    var { cart } = useCart()
    return <>

        <a class="nav-link text-center" href="/cart"><i class="fa fa-shopping-cart"></i>&nbsp; Cart({Object.keys(cart).length})</a>
    </>
}

export default Header;

if (document.getElementById('cartcontainer')) {
    ReactDOM.render(<Header />, document.getElementById('cartcontainer'));
}
