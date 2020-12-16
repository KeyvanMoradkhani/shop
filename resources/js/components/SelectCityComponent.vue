<template>
    <div>
        <div class="form-group required">
            <label for="input-country" class="col-sm-2 control-label">استان</label>
            <div class="col-sm-10">
                <select  class="form-control" id="input-country" name="province_id" v-model="province_id" @change="getAllCities()">
                    <option>--- لطفا انتخاب کنید ---  </option>
                    <option  v-for="province in provinces[0]"  :key="province.id" :value="province.id">{{province.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group required" v-if="this.cities.length>0">
            <label for="input-city" class="col-sm-2 control-label">شهر</label>
            <div class="col-sm-10">
                <select class="form-control" id="input-city" name="city_id">
                    <option  v-for="city in cities"  :key="city.id" :value="city.id">{{city.name}}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
          return{
              provinces: [],
              cities: [],
              province_id: '',
              flag :false,
          }
        },
        mounted() {
            axios.get('/api/province').then(
                res=>{
                    this.provinces.push(res.data);
                }
            ).catch(err=>{
                console.log(err)
            })
        },
        methods  :{
            getAllCities : function(){
                axios.get('/api/cities/'+this.province_id).then(
                    res=>{
                        this.cities=res.data;
                    }
                ).catch(err=>{
                    console.log(err)
                })
            }
        }
    }
</script>
