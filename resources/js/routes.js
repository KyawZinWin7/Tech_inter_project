export const routes = [
    {
        path: "/",
        component: render("Home"),
    },
    {
        path: "/auth/login",
        component: render("auth/Login"),
    },
    {
        path: "/auth/register",
        component: render("auth/Register"),
    },
    {
        path: "/category/index",
        component: render("category/CategoryComponent"),
        meta: { auth: true },
    },
    {
        path: "/category/create",
        component: render("category/CategoryCreateComponent"),
        meta: { auth: true },
    },
    {
        path: "/category/edit/:id",
        props: true,
        component: render("category/CategoryEditComponent"),
        meta: { auth: true },
    },
];

function render(template) {
    return require(`./components/${template}.vue`).default;
}
