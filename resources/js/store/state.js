let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');

let state = {
    id: null,
    cart: cart ? JSON.parse(cart) : [],
    cartCount: cartCount ? parseInt(cartCount) : 0,

    comments: [],
    ratings: [],

    meal_slug: null,

    favShop: [],
    favMeal: [],

    vMeal: {},
    vMeals: [],
    sale:'',
    vRating: 0,

    months: ["January", "February", "March", "April", "May", 
            "June", "July", "August", "September", 
            "October", "November", "December"],

    message: '',
    search:'',
    searches: [],

    user:[],

    oOrders:[],
    cOrders:[],

    shop_name: null,

}

export default state