<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Listing Blotters</div>

                    <ul>
                        <li v-for="blotter in blotters">{{ blotter }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
   import axios from 'axios';

   export default {
      data: () => ({
        blotters: []
      }),

      created() 
      {
         axios.get('http://localhost/clearance/api/resident/blotter').then(response => this.blotters = response.data);
      }

    }
</script>
