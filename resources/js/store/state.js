let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');

let state = {
    id: null,
    shop_name: null,
    shop: {},

    master_image: null,
    meal_images: [],
    
    cart: cart ? JSON.parse(cart) : [],
    cartCount: cartCount ? parseInt(cartCount) : 0,

    comments: [],
    ratings: [],

    meal_slug: null,

    favShop: [],
    favMeal: [],

   // vMeal: {},
    vendorMeals: [],
    sale:'',
    vRating: 0,

    months: ["January", "February", "March", "April", "May", 
            "June", "July", "August", "September", 
            "October", "November", "December"],

    message: null,
    search:'',
    searches: [],

    user:[],

    oOrders:[],
    cOrders:[],

    undelivered:[],
    delivered:[],

    selectedmeal:{},
    selected_meal_image: [],
    selected_meal_size: [],

}

export default state