import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "@/store/auth/AuthStore";
import { usePreLoader } from "@/store/system/PreLoader";
import ability from '@/Ability';
import { $Log } from '@/helpers/Debug';

const router = createRouter({
  history: createWebHistory(import.meta.env.APP_URL),
  scrollBehavior(to, from, savedPosition) {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        resolve({ left: 0, top: 0, behavior: 'smooth' })
      }, 500)
    })
  },
  routes: [
    // NOTE PAGES
    {
      path: "/",
      name: 'home',
      component: () => import('@/views/pages/home/@HomePage.vue'),
      meta: {
        title: 'Home',
      }
    },
    {
      path: "/about",
      name: 'about',
      component: () => import('@/views/pages/about/@AboutPage.vue'),
      meta: {
        title: 'About',
      }
    },
    {
      path: '/job-listing',
      name: 'job-listing',
      component: () => import('@/views/jobs/JobsListingPage.vue'),
      meta: {
        title: 'Job Listing'
      }
    },
    {
      path: '/job/:id',
      name: 'job-view',
      component: () => import('@/views/job/JobViewPage.vue'),
      meta: {
        title: 'Job'
      }
    },
    {
      path: '/calendar',
      name: 'calendar',
      component: () => import('@/views/pages/calendar/CalendarPage.vue'),
      meta: {
        title: 'Calendar'
      }
    },
    {
      path: '/faqs',
      name: 'faqs',
      component: () => import('@/views/pages/faqs/FaqsPage.vue'),
      meta: {
        title: 'FAQs'
      }
    },
    {
    path: '/news',
    name: 'news',
      component: () => import('@/views/pages/news/NewsUpdates.vue'),
      meta: {
        title: 'News & Updates'
      }
    },
    {
    path: '/news/:id',
    name: 'post',
      component: () => import('@/views/pages/news/PostPage.vue'),
      meta: {
        title: 'Post'
      }
    },

    // NOTE AUTH =================================================================
    {
      path: "/login",
      name: "login",
      component: () => import("@/views/auth/LoginPage.vue"),
      meta: {
        title: "Login",
      },
    },
    {
      path: "/register",
      name: "register",
      component: () => import("@/views/auth/RegisterPage.vue"),
      meta: {
        title: "Register",
      },
    },
    {
      path: "/forgot",
      name: "forgot",
      component: () => import("@/views/auth/ForgotPage.vue"),
      meta: {
        title: "Forgot Password",
      },
    },
    // {
    //   path: "/forgot/fill",
    //   name: "forgot-recovery",
    //   component: () => import("@/views/auth/RecoveryPage.vue"),
    //   meta: {
    //     title: "Recovery",
    //   },
    // },
    // {
    //   path: "/register",
    //   name: "register",
    //   component: () => import("@/views/auth/RegisterPage.vue"),
    //   meta: {
    //     title: "Register",
    //   },
    // },
    // {
    //   path: "/register/fill",
    //   name: "register-fill",
    //   component: () => import("@/views/auth/RegisterFillPage.vue"),
    //   meta: {
    //     title: "Register",
    //   },
    // },
    // NOTE DASHBOARD
    {
      path: "/dashboard",
      name: "dashboard",
      component: () => import("@/views/dashboard/DashboardPage.vue"),
      meta: {
        sideBar: true,
        title: "Dashboard",
        auth: true,
      },
    },
    // NOTE TRANSACTIONS
    // {
    //   path: "/transactions-all",
    //   name: "transactions-all",
    //   component: () => import("@/views/transaction/AllTransactionPage.vue"),
    //   meta: {
    //     title: "Transactions",
    //     // role: 5, //admin
    //     auth: true,
    //     sideBar: true,
    //   },
    // },
    // {
    //   path: "/overdue",
    //   name: "overdue",
    //   component: () => import("@/views/users/overdue/OverduePage.vue"),
    //   meta: {
    //     title: "Overdue",
    //     role: 5, //admin
    //     auth: true,
    //     sideBar: true,
    //   },
    // },
    // NOTE PLANS
    // {
    //   path: "/plans",
    //   name: "plans",
    //   component: () => import("@/views/plans/PlanPage.vue"),
    //   meta: {
    //     title: "Plans' Management",
    //     role: 2, //admin
    //     auth: true,
    //     sideBar: true,
    //   },
    // },
    // NOTE USERS
    // {
    //   path: '/users/clients',
    //   name: 'users-clients',
    //   component: () => import("@/views/users/clients/ClientPage.vue"),
    //   meta: {
    //     title: 'Clients Management',
    //     // role: 5,
    //     auth: true,
    //     sideBar: true,
    //   }
    // },
    // {
    //   path: '/users/overdue',
    //   name: 'users-overdue',
    //   component: () => import("@/views/users/overdue/OverduePage.vue"),
    //   meta: {
    //     title: 'Overdue Management',
    //     // role: 5,
    //     auth: true,
    //     sideBar: true,
    //   }
    // },
    // {
    //   path: "/users/list",
    //   name: "users-list",
    //   component: () => import("@/views/users/users/UsersPage.vue"),
    //   meta: {
    //     title: "Users' Management",
    //     role: 2, //admin
    //     auth: true,
    //     sideBar: true,
    //   },
    // },
    // {
    //   path: "/users/roles",
    //   name: "users-roles",
    //   component: () => import("@/views/users/roles/RolePage.vue"),
    //   meta: {
    //     title: "User's Roles",
    //     role: 2, //admin
    //     auth: true,
    //     sideBar: true,
    //   },
    // },
    // {
    //   path: '/user/:id',
    //   name: 'user',
    //   component: () => import("@/views/user/UserPage.vue"),
    //   meta: {
    //     title: "User Details",
    //     // role: 5,
    //     auth: true,
    //     sideBar: true,
    //   }
    // },
    // NOTE CLIENTS
    // {
    //   path: "/clients",
    //   name: "clients-list",
    //   component: () => import("@/views/clients/ClientPage.vue"),
    //   meta: {
    //     title: "Users' Management",
    //     role: 5, //client only
    //     auth: true,
    //     sideBar: true,
    //   },
    // },
    // NOTE ACCOUNT SETTINGS
    // {
    //   path: "/account-settings",
    //   name: "account-settings",
    //   component: () =>
    //     import(
    //       "@/views/account-settings/AccountSettingsPage.vue"
    //     ),
    //   meta: {
    //     title: "Account Settings",
    //     auth: true,
    //     sideBar: true,
    //   },
    // },
    // NOTE OTHER
    {
      path: "/:pathMatch(.*)*",
      name: 'error',
      component: () => import("@/views/pages/ErrorPage.vue"),
      meta: {
        title: "Page not Found!",
      },
    },
  ],
});
const TITLE = "CMU | HRMO";

router.beforeEach(async (to, from) => {
  const $load = usePreLoader();
  const $auth = useAuthStore();
  $load.config.loading = true
  $load.config.to = to.name

  if($auth.token && $auth.content) {
    ability.update([
      ...$auth.content.permissions.map((str) => {
        return {
          action: str.split(' ')[0],
          subject: str.split(' ')[1],
        }
      })
    ])
  }

  $Log('Route Permissions Updated', $auth.content.permissions)
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

});

router.afterEach((to) => {
  const $load = usePreLoader()
  $load.config.loading = false

  document.title = to.meta.title ? `${to.meta.title} | ${TITLE}` : "";
});

export default router;