<template>
    <div>
        <div class="form-group">
            <label>دسته بندی</label>
            <select class="form-control" name="categories[]" style="width: 100%;" aria-hidden="true" v-model="categories_selected" @change="onChange($event,null)" multiple="true">
                <option v-for="category in categories"  :key="category.id"  :value="category.id" >{{category.name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label>برند </label>
            <select v-if="!product" class="form-control" name="brand" style="width: 100%;" aria-hidden="true">
                <option  v-for="brand in brands"  :key="brand.id" :value="brand.id" >{{brand.title}}</option>
            </select>
            <select v-if="product" class="form-control" name="brand" style="width: 100%;" aria-hidden="true">
                <option v-for="brand in brands"  :key="brand.id" :value="brand.id" :selected="product.brand.id === brand.id" >{{brand.title}}</option>
            </select>
        </div>
        <div v-if="flag">
            <div class="form-group"  v-for="(attribute ,index) in attributes" :key="attribute.id">
                <label> {{attribute.title}} برند </label>
                <select v-if="!product" class="form-control"  style="width: 100%;" aria-hidden="true" @change="addAttribute($event,index)">
                    <option >انتخاب کنید...</option>
                    <option  v-for="attributeValue in attribute.atrribute_value"  :key="attributeValue.id" :value="attributeValue.id">{{attributeValue.title}}</option>
                </select>
                <select v-if="product" class="form-control"  style="width: 100%;" aria-hidden="true" @change="addAttribute($event,index)">
                    <option >انتخاب کنید...</option>
                    <option  v-for="attributeValue in attribute.atrribute_value"  :key="attributeValue.id" :value="attributeValue.id"
                     :selected="product.atrributevalues[index].id === attributeValue.id">{{attributeValue.title}}</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="attributes[]" :value="computedAttribute">


    </div>
</template>

<script>
    export default {
        data(){
          return{
              categories: [],
              categories_selected: [],
              flag :false,
              attributes :[],
              selectAttribute:[],
              computedAttribute:[]
          }
        },
        props:['brands','product'],
        mounted() {
            axios.get('/api/categories').then(
                res=>{
                    this.getAllChildren(res.data.categories,0);
                }
            ).catch(err=>{
                console.log(err)
            })

            if(this.product){
                for(var i=0;i<this.product.categories.length;i++){
                    this.categories_selected.push(this.product.categories[i].id);
                }
                for(var i=0;i<this.product.atrributevalues.length;i++){
                   this.selectAttribute.push({
                    'index':i,
                    'value':this.product.atrributevalues[i].id
                    })
// console.log(this.selectAttribute);
                    this.computedAttribute.push(this.product.atrributevalues[i].id);

                }
                const load = 'ok';
                this.onChange(null,load);
            }
        },
        methods  :{
            getAllChildren : function(currentValue,level){
                for(var i=0 ; i<currentValue.length ; i++){
                    var current =  currentValue[i];
                    this.categories.push({
                        id:current.id,
                        name:Array(level+1).join('-----')+" "+current.name
                    })
                    if(current.children_recursive && current.children_recursive.length >0){
                        this.getAllChildren(current.children_recursive,level+1)
                    }
                }

            },
            onChange : function(event,load){
                this.flag=false;
                axios.post('/api/categories/attribute',this.categories_selected).then(

                    res=>{
                        if(this.product && load == null){
                            this.computedAttribute=[];
                            this.selectAttribute=[]
                        }
                        this.attributes= res.data.attribute;
                        this.flag=true;
                    }
                ).catch(err=>{
                    console.log(err)
                    this.flag=false;
                })
            },
            addAttribute : function(event,index){
                console.log(event.target.value,index);
                for(var i=0 ; i<this.selectAttribute.length ;i++){
                    var currentvalue =  this.selectAttribute[i];
                    if(currentvalue.index == index){
                        this.selectAttribute.splice(i,1);
                    }
                }
                this.selectAttribute.push({
                    'index':index,
                    'value':event.target.value
                })
                this.computedAttribute=[]
                 for(var i=0 ; i<this.selectAttribute.length ;i++){
                    this.computedAttribute.push(this.selectAttribute[i].value);
                }

            }

        }
    }
</script>
