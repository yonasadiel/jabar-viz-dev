<template>
  <div>
    <Navbar></Navbar>
    <h1 class="title">Jabar Viz Dev Account Management</h1>
    <div class="container__edit">
        <div class="header">
            <h3>Manage Users</h3>
        </div>
        <div class="container__table">
            <div class="flex-row">
                <div class="flex-col col-header">
                    <div class="row-header">User</div>
                    <div class="row-entry user" v-for="user in users" @click="displayModalUser">
                        {{ user.name }}
                    </div>
                    <ModalUser v-if="showModalUser" @close="showModalUser = false"></ModalUser>
                </div>
                <div class="flex-col col-entry">
                    <div class="row-header">Role</div>
                    <div class="row-entry role" v-for="user in users">
                        {{ user.role }} <button class="btn__edit--role" @click="displayModalRole">Edit</button>
                    </div>
                    <ModalEditRole v-if="showModalRole" @close="showModalRole = false"></ModalEditRole>
                </div>
            </div>
        </div>
        <button class="btn__add--user">Add new user</button>
    </div>
  </div>
</template>

<script>
import ModalUser from '@/components/ModalUser.vue';
import ModalEditRole from '@/components/ModalEditRole.vue';
export default {
  name: 'ManageAccount',
  components: {
      ModalUser: ModalUser,
      ModalEditRole: ModalEditRole
  },
  data() {
      return {
        users: [
            {name: 'Jaenudin', email: 'jaenudin@gmail.com', insitusi: 'pemprov', role:'Admin'},
            {name: 'Adel', email: 'adel@gmail.com', insitusi: 'bapeda', role:'editor'},
            {name: 'Brokoli', email: 'brokoli@gmail.com', insitusi: 'bpjs', role:'editor'},
            {name: 'Meganus', email: 'meganus@gmail.com', insitusi: 'perda', role:'editor'},
            {name: 'Charlotte', email: 'charlotte@gmail.com', insitusi: 'bpk', role:'editor'},
            {name: 'Kokoro', email: 'kokoro@gmail.com', insitusi: 'kpk', role:'editor'},
            {name: 'No Tomo', email: 'no-tomo@gmail.com', insitusi: 'lpm', role:'editor'},
            {name: 'Brigadir', email: 'brigadir@gmail.com', insitusi: 'BI', role:'editor'},
        ],
        showModalUser: false,
        showModalRole: false
      }
  },
  methods: {
      displayModalUser: function() {
          this.showModalUser = true;
      },
      displayModalRole: function() {
          this.showModalRole = true;
      }
  }
};
</script>

<style scoped>
.title {
    text-align: center;
}

.container__edit {
    padding: 15px 220px;
}

.container__table {
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.btn__add--user {
    float: right;
    border: 0;
    background-color: rgba(6, 116, 210, 1);
    border-radius: 5px;
    box-shadow: 2px 2px 8px 2px rgba(0, 0, 0, .2);
    padding: 10px 15px;
    cursor: pointer;
    font-weight: 600;
    margin: 10px 0;
    color: white;
}

.btn__add--user:hover {
    background-color: rgb(10, 84, 150);
    transform: scale(1.1);
}

.btn__edit--role {
    float: right;
    border: 0; 
    background-color: skyblue;
    border-radius: 5px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    padding: 5px 20px;
}

.btn__edit--role:hover {
    background-color: rgba(6, 116, 210, 1);
}

.flex-row {
    display: flex;
    flex-direction: row;
}

.flex-col {
    display: flex;
    flex-direction: column;
}

.row-header {
    font-weight: 600;
    height: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, .1);
}

.col-header {
    flex: 1 1;
}

.row-entry {
    height: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.user {
    cursor: pointer;
}

.user:hover {
    background-color: rgba(0, 0, 0, .05);
    font-weight: 600;
}

.role {
    display: inline-block;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.col-entry {
    flex: 0 0;
    flex-basis: 150px;
}

</style>
