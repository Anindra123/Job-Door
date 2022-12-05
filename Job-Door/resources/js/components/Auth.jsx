export const isUserLoggedIn = (reqCookies) => {
    if (!reqCookies) return Cookies.get();
    router.pushUrl();
};
