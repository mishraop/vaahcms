let routes= [];
let routes_list= [];

import List from '../pages/followups/List.vue'
import Form from '../pages/followups/Form.vue'
import Item from '../pages/followups/Item.vue'

routes_list = {

    path: '/followups',
    name: 'followups.index',
    component: List,
    props: true,
    children:[
        {
            path: 'form/:id?',
            name: 'followups.form',
            component: Form,
            props: true,
        },
        {
            path: 'view/:id?',
            name: 'followups.view',
            component: Item,
            props: true,
        }
    ]
};

routes.push(routes_list);

export default routes;

