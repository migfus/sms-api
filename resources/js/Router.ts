import { createRouter, createWebHistory, isNavigationFailure, NavigationFailureType } from "vue-router"
import { useAuthStore } from "@/store/@auth/AuthStore"
import { usePreLoader } from "@/store/system/PreLoader"
import ability from '@/Ability'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    // NOTE PAGES
    {
      path: "/",
      name: 'register',
      component: () => import('@/views/register/index.vue'),
      meta: {
        title: 'Register',
      }
    },

    {
      path: "/login",
      name: 'login',
      component: () => import('@/views/login.vue'),
      meta: {
        title: 'Login',
      }
    },

    // NOTE OTHER
    {
      path: "/:pathMatch(.*)*",
      name: 'error',
      component: () => import("@/views/[error].vue"),
      meta: {
        title: "Page not Found!",
      },
    },
  ],
});


const TITLE = "CMU OHRM ID"
router.beforeEach(async (to, from, next) => {
  const $load = usePreLoader()
  const $auth = useAuthStore()

  $load.config.loading = true
  $load.config.to = to.name

  $auth.UpdateAbility()

  const canNavigate = to.matched.some(row => {
    if(row.meta.resource) {
      // @ts-ignore
      return ability.can(row.meta.action || 'index', row.meta.resource)
    }
    return true;
  })

  // const $auth = useAuthStore();

  // if ($auth.token == "" && to.name !== "login") {
  //   return { name: "login" };
  // }

  // if(to.meta.auth && $auth.token == '' && to.meta.name != 'login') {
  //   return { name: 'login'};
  //   // return false
  // }

  // if(to.meta.role) {
  //   if($auth.content.auth.role == 2) {

  //   }
  //   else if(to.meta.role != $auth.content.auth.role && to.meta.name != 'error') {
  //     // return { name: 'error'}
  //     return false
  //   }
  // }
  if(!canNavigate) {
    next(new Error('Route Disabled (no permission)'))
  }

  next()
});

router.afterEach((to, from, failure) => {

  const $load = usePreLoader()
  $load.config.loading = false

  document.title = to.meta.title ? `${to.meta.title} | ${TITLE}` : "";
})

export default router;
