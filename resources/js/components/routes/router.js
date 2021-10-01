import Vue from 'vue';
import Login from '../pages/Login'
import Dashboard from '../pages/Dashboard'
import Team from '../pages/Team'
import Workspace from '../pages/Workspace'
import Project from '../pages/Project'
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const routes = [
    { path: '/', component: Login },
    { path: '/dashboard', component: Dashboard },
    { path: '/team', component: Team },
    { path: '/project', component: Workspace },
    { path: '/project/:id', component: Project }
]

export default new VueRouter({
    mode: 'history',
    routes: routes,
})