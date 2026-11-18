Q1: Authentication and authorisation are not the same. In one sentence each: what did this lesson give you, and what is still missing next meeting?

Answer: This lesson gave my Movie Flex app authentication, which means it now knows who the user is, because they can register, login and logout. What is still missing is authorisation, which means checking what each user is allowed to do, because right now any signed in user can edit or delete any movie.

Q2: Why does a successful login call session()->regenerate()? What goes wrong if you skip it?

Answer: session()->regenerate() gives the user a brandnew session id right after they log in. If I skip it, an attacker could give me a session id before I log in, and after I log in they could use that same id to act as me.

Q3: Why does a failed login use the same message for a wrong password and an unknown email?

Answer: Stranger could type any email and find out which ones are registered in my app. With the same message for both, they only learn that the login failed, not why. That makes it harder for someone to guess real accounts.

Q4: Why do index and show stay public while create/edit/update/destroy use auth?

Answer: Anyone should be able to browse my movie list and open a movie's details, so index and show stay public. Creating, editing, updating and deleting change the data in my app, so those use auth and only signed-in users can reach them.

Q5: You hid Add (and actions) for guests. Why is that not enough to secure those actions? What actually stops a stranger?

Answer: Hiding the Add, Edit and Delete buttons only changes what a guest can see. The addresses still exist, so a guest can type /movies/create straight into the browser. The auth middleware on those routes is what really stops them, because it sends them to the login page.

Q6: In screenshot 20 the route name was wrong. Why does auth middleware care that the route is named exactly login?

Answer: When a guest opens a locked page, the auth middleware sends them to the route named exactly login. When I renamed it to signin, the middleware could not find any route called login, so the page crashed with "Route [login] not defined".
