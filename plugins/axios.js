export default function ({ $axios, app, redirect }) {
    $axios.onError(error => {
      if(error.response.status === 500) {
        redirect('/sorry')
      }
    })
    const token = app.$cookiz.get('authToken');
    if (token) {
        $axios.setHeader('Authorization', `Bearer ${token}`);
    }
}