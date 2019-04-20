<template>
  <div>
    <Navbar />
    <div class="d-flex flex-column align-items-center container" >
      <h1 class="title">Login</h1>
      <form @submit="checkLogin" id="login-form">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" v-model="username"name="username">
        </div>
        <div class="form-group">
            <label htmlFor="password">Password</label>
            <input type="password" v-model="password" name="password">
        </div> 
        <div class="form-group form-button">
            <button class="btn login" v-on:click="saveUser">Login</button>
            <!--<div class="register">
            	<router-link to="/register" class="btn btn-link">Register</router-link>
            </div>-->
        </div>
    	</form>
    </div>
  </div>
</template>

<script>
import api from '@/api';
export default {
  name: 'Login',
  components: {
  },

  methods:{
    checkLogin: function (e) {
      if (this.username && this.password) {
      	return true;
      }

      this.errors = [];

      if (!this.username) {
        this.errors.push('Name required.');
      }
      if (!this.password) {
        this.errors.push('Password required.');
      }

      e.preventDefault();
    },
    loginUser: function(){
    	api.post('/login', {
	      username: this.username,
	      password: this.password,
	    })
    }
  }
};
</script>

<style scoped lang="scss">
@import '../styles/components/form';

.title {
    text-align: center;
    margin: 1.5em 0;
}

.btn.login {
    text-align: center;
}

.form-button{
	text-align: center;
}

.register{
	margin-top: 5px;
}
</style>