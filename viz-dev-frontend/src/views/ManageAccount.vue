<template>
  <div>
    <Navbar />
    <div class="d-flex flex-column align-items-center container" >
      <h1 class="title">Manajemen User</h1>
      <button
        class="btn add-user align-self-start"
        v-on:click="toggleModalUserCreate">
          Tambah User
      </button>
      <Loader v-if="isLoadingUser"/>
      <ModalUserCreate
        v-if="showModalUserCreate"
        @modalClosed="toggleModalUserCreate" />
      <ModalUserEdit
        v-bind="propsModalUserEdit"
        v-if="showModalUserEdit"
        @modalClosed="toggleModalUserEdit" />
      <div class="table" v-if="!isLoadingUser">
        <div class="table-row table-header">
          <div class="table-cell flex-1 username">User</div>
          <div class="table-cell flex-2 email">Email</div>
          <div class="table-cell flex-0 center role">Role</div>
          <div class="table-cell flex-0 center action">Aksi</div>
        </div>
        <div class="table-row" v-for="user in users" v-bind:key="user.username">
          <div class="table-cell flex-1 username">{{user.username}}</div>
          <div class="table-cell flex-2 email">{{user.email}}</div>
          <div class="table-cell flex-0 center role">{{user.role}}</div>
          <div class="table-cell flex-0 center action">
            <button class="btn" v-on:click="toggleModalUserEdit(user.id)">Ubah</button>
            <button class="btn danger" v-on:click="deleteUser(user.id)">Hapus</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/api';
import Loader from '@/components/Loader.vue';
import ModalUserCreate from '@/components/ModalUserCreate.vue';
import ModalUserEdit from '@/components/ModalUserEdit.vue';

export default {
  name: 'ManageAccount',
  components: {
    Loader,
    ModalUserCreate,
    ModalUserEdit,
  },
  created() {
    this.retrieveUser();
  },
  methods: {
    retrieveUser() {
      this.isLoadingUser = true;
      api.get('/users').then((res) => {
        this.users = res.data;
        this.isLoadingUser = false;
      });
    },
    toggleModalUserCreate() {
      if (this.showModalUserCreate) {
        // update user list after editing
        this.retrieveUser();
      }

      this.showModalUserCreate = !this.showModalUserCreate;
    },
    toggleModalUserEdit(userId) {
      if (this.showModalUserEdit) {
        // update user list after editing
        this.retrieveUser();
      } else {
        // pass user to modal
        for (let i = 0; i < this.users.length; i += 1) {
          if (this.users[i].id === userId) {
            this.propsModalUserEdit.user = this.users[i];
          }
        }
      }

      this.showModalUserEdit = !this.showModalUserEdit;
    },
    deleteUser(userId) {
      /* eslint-disable no-restricted-globals */
      /* eslint-disable no-alert */
      if (confirm('yakin hapus user ini?')) {
        api.delete(`/users/${userId}`).then(() => {
          this.retrieveUser();
        });
      }
    },
  },
  data() {
    return {
      users: [],
      isLoadingUser: true,
      showModalUserEdit: false,
      showModalUserCreate: false,
      propsModalUserEdit: {
        user: null,
      },
    };
  },
};
</script>

<style scoped lang="scss">
@import '../styles/components/table';

.title {
  text-align: center;
  margin: 1.5em 0;
}

.btn.add-user {
  margin-left: 0;
}

.table {
  width: 100%;
  .table-cell.username { flex-basis: 100px; }
  .table-cell.email { flex-basis: 250px; }
  .table-cell.role { flex-basis: 100px; }
  .table-cell.action {
    flex-basis: 170px;

    .btn {
      padding: 5px 10px;
    }

    .btn.danger {
      background-color: rgba(250, 100, 100, 1);
    }

    .btn.danger:hover {
      background-color: rgba(250, 40, 40, 1);
    }
  }
}

</style>
