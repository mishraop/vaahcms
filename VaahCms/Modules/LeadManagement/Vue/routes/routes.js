let routes= [];

import dashboard from "./vue-routes-dashboard";
import leads from "./vue-routes-leads";     
import followups from "./vue-routes-followups";     
import tags from "./vue-routes-tags";     

routes = routes.concat(dashboard);
routes = routes.concat(leads);
routes = routes.concat(followups);
routes = routes.concat(tags);

export default routes;
