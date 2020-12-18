export function isLoggedIn() {
    return localStorage.getItem("isLoggedIn") === 'true';
}

export function logIn() {
    localStorage.setItem("isLoggedIn", 'true');
}

export function logOut() {


    axios.get('/logout2').then(response => {
            if (response.status === 200)
                localStorage.setItem("isLoggedIn", 'false');
        }
    );
    this.$router.go(0);

}

