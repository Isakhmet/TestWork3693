import axios from 'axios';

export default {
    state:     {
        users: []
    },
    getters:   {
        allUsers(state) {
            return state.users
        }
    },
    mutations: {
        updateUsers(state, users) {
            state.users = users;
        },
        addNewUser(state, user) {
            state.users.push(user)
        },
        setDeleteUser(state, id) {
            state.users = state.users.filter(user => user.id !== id);
        },
        setUpdateUser(state, user) {
            state.users = state.users.filter(x => x.id !== user.id);
            state.users.unshift(user);
        }
    },
    actions:   {
        async fetchUsers(ctx) {
            const res   = await fetch(`${process.env.VUE_APP_API_URL}`);
            const users = await res.json();
            ctx.commit('updateUsers', users)
        },
        createUser(ctx, user) {
            return new Promise((resolve, reject) => {
                    axios.post(`${process.env.VUE_APP_API_URL}create`, user)
                        .then(res => {
                            if (res.data.success) {
                                ctx.commit('addNewUser', res.data.data);
                                console.log(res.data)
                            } else {
                                resolve(res.data);
                            }
                        }).catch((err) => {
                        if (err.response) {
                            reject(err.response.message)
                        } else {
                            reject(err)
                        }
                        console.log(err.message);
                    });
                }
            )
        },
        updateUser(ctx, user) {
            return new Promise((resolve, reject) => {
                    axios.post(`${process.env.VUE_APP_API_URL}update`, user)
                        .then(res => {
                            if (res.data.success) {
                                ctx.commit('setUpdateUser', res.data.data);
                            } else {
                                resolve(res.data);
                            }
                        }).catch((err) => {
                        if (err.response) {
                            reject(err.response.message)
                        } else {
                            reject(err)
                        }
                        console.log(err.message);
                    });
                }
            )
        },
        deleteUser(ctx, id) {
            return new Promise((resolve, reject) => {
                    axios.post(`${process.env.VUE_APP_API_URL}delete`, {'id': id})
                        .then(res => {
                            console.log(res)
                            if (res.data.success) {
                                ctx.commit('setDeleteUser', id);
                            } else {
                                resolve(res.data);
                            }
                        }).catch((err) => {
                        if (err.response) {
                            reject(err.response.status + ' ' + err.response.statusText)
                        } else {
                            reject(err)
                        }
                    });
                }
            )
        }
    },
}