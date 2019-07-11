export default function ({store, redirect}) {
  if(store.$auth.loggedIn){
    return redirect('/');
  }
}
