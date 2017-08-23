<template>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Listing Blotters</div>
                      <table class="table">
                          <thead>
                            <tr><th>Person Blotter Full Name</th><th>Witness Full Name</th> <th>Date and time </th> <th> Status </th> <th> Actions</th></tr>
                          </thead>
                          <tbody>
                            <tr v-for="blotter in blotters">
                              <td>{{ blotter.blotter_fullname }}</td>
                              <td>{{ blotter.witness_fullname }}</td>
                              <td>{{ blotter.date+' '+blotter.hour}}</td>
                              <td>Pending</td>
                              <td><a href="#" class="btn btn-info btn-sm">Edit </a> <a href="#" class="btn btn-primary btn-sm">View </a> <a href="#" v-on:click="deleteBlotter(blotter.id)" class="btn btn-danger btn-sm">Delete </a></td>
                            </tr>
                          </tbody>
                      </table>
                </div>
            </div>
</template>

<script>
   import axios from 'axios';
   export default {
      data: () => ({
        blotters: [],
        base_url : 'http://localhost/clearance/api/',
      }),

      created() 
      {
         let user_id = $('#userid').val();
         axios.get(this.base_url+'resident/blotter/'+user_id).then(response => this.blotters = response.data);
      },
      methods: {
        deleteBlotter: function(blotterid)
        {
          alert(blotterid);
          axios.get('http://localhost/clearance/api/resident/blotter/delete/'+blotterid).then(response => this.blotters = response.data);

        }
      },

    }
</script>
