import store from './store';
import api from './api';

async function getCurrentSession() {
  try {
    const response = await api.get('/me/', { ignoreUnauthorizedError: true });
    return response.data;
  } catch (err) {
    return null;
  }
}

export async function requireLogin(_, from, next) {
  const redirectTo = { name: 'Home', replace: true };

  if (store.getters['auth/isLoggedIn']) {
    next();
    return;
  }

  const user = await getCurrentSession();
  if (user) {
    store.commit('auth/setUser', user);
    next();
    return;
  }

  next(redirectTo);
}

export async function requireAdmin(_, from, next) {
  const redirectTo = { name: 'Home', replace: true };

  if (store.getters['auth/isAdmin']) {
    next();
    return;
  }

  const user = await getCurrentSession();
  if (user) {
    if (user.role === 'admin') {
      store.commit('auth/setUser', user);
      next();
      return;
    }
  }

  next(redirectTo);
}

export async function requireGuest(_, from, next) {
  const redirectTo = { name: 'Home', replace: true };

  if (store.getters['auth/isLoggedIn']) {
    next(redirectTo);
    return;
  }

  const user = await getCurrentSession();
  if (user) {
    store.commit('auth/setUser', user);
    next(redirectTo);
    return;
  }

  next();
}
