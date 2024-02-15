
export function authMiddleware(to, from, next) {
    const isAuthenticated = localStorage.getItem('accessToken');
    if (to.path.startsWith('/panel')) {
      if (isAuthenticated) {
        // User is authenticated, allow access to the route
        next();
      } else {
        // User is not authenticated, redirect to login page
        next('/auth/login');
      }
    } else {
      // For routes outside of panel, continue as usual
      next();
    }
  }
  