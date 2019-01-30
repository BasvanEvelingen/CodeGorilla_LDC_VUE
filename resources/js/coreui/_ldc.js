export default {
  items: [
    {
      name : 'Hoofdmenu',
      url  : '/dashboard',
      icon : 'icon-speedometer',
      badge: {
        variant: 'primary',
        text   : 'NEW',
      },
    },
    
    {
      name    : 'Paginas',
      url     : '/pages',
      icon    : 'icon-star',
      children: [
        {
          name: 'Login',
          url : '/pages/login',
          icon: 'icon-star',
        },
        {
          name: 'Register',
          url : '/pages/register',
          icon: 'icon-star',
        },
        {
          name: 'Error 404',
          url : '/pages/404',
          icon: 'icon-star',
        },
        {
          name: 'Error 500',
          url : '/pages/500',
          icon: 'icon-star',
        },
      ],
    },

  ],
}
