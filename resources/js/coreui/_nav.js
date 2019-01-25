export default {
  items: [
    {
      name: 'Dashboard',
      url : '/dashboard',
      icon: 'icon-speedometer',
    },
    {
      title  : true,
      name   : 'Gebruikers',
      class  : '',
      wrapper: {
        element   : '',
        attributes: {},
      },
    },
    {
      name: 'Testen',
      url : '/base/carousels',
      icon: 'icon-puzzle',
    },
    {
      name: 'Uitslagen voorbeeld',
      url : '/charts',
      icon: 'icon-pie-chart',
    },
    {
      title  : true,
      name   : 'AI opdracht',
      class  : '',
      wrapper: {
        element   : '',
        attributes: {},
      },
    },
    {
      name    : 'Submenu',
      url     : '/base',
      icon    : 'icon-puzzle',
      children: [
        {
          name: 'Kruimelspoor',
          url : '/base/breadcrumbs',
          icon: 'icon-puzzle',
        },
        {
          name: 'Bootstrap Cards',
          url : '/base/cards',
          icon: 'icon-puzzle',
        },
      ],
    },
    {
      name   : 'CodeGorilla',
      url    : 'http://codegorilla.nl/',
      icon   : 'icon-cloud-download',
      class  : 'mt-auto',
      variant: 'success',
    },
  ],
}
