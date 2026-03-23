let routes= [];
let routes_list= [];

import List from '../pages/leads/List.vue'
import Form from '../pages/leads/Form.vue'
import Item from '../pages/leads/Item.vue'

routes_list = {

    path: '/leads',
    name: 'leads.index',
    component: List,
    props: true,
    children:[
        {
            path: 'form/:id?',
            name: 'leads.form',
            component: Form,
            props: true,
        },
        {
            path: 'view/:id?',
            name: 'leads.view',
            component: Item,
            props: true,
        }
    ]
};

routes.push(routes_list);

export default routes;

