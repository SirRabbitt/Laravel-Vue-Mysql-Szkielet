import{T as c,o as p,c as m,b as e,f as n,v as i,u as r,g as f,h as d}from"./app-BtwkhbaL.js";const _={class:"mb-8 mt-4 flex flex-wrap gap-2"},v={class:"flex flex-nowrap items-center"},x={class:"flex flex-nowrap items-center"},g={class:"flex flex-nowrap items-center"},h=e("label",{for:"perPage",class:"mr-2"},"wielkosc tabeli :",-1),w=e("option",{value:"10"},"10",-1),b=e("option",{value:"20"},"20",-1),P=e("option",{value:"50"},"50",-1),k=e("option",{value:"100"},"100",-1),y=[w,b,P,k],M=e("button",{type:"submit",class:"btn-normal mr-2"},"Filter",-1),F={__name:"filters",setup(S){const o={name:route().params.name??"",manufacturer:route().params.manufacturer??"",perPage:route().params.perPage??20},t=c({name:o.name,manufacturer:o.manufacturer,perPage:o.perPage}),l=()=>{t.get(route("listing.index"),{preserveState:!0,preserveScroll:!0})},u=()=>{t.name="",t.manufacturer="",t.perPage=20,l()};return(V,a)=>(p(),m("form",{onSubmit:d(l,["prevent"])},[e("div",_,[e("div",v,[n(e("input",{"onUpdate:modelValue":a[0]||(a[0]=s=>r(t).name=s),type:"text",placeholder:"Product name",class:"input-filter-l w-56"},null,512),[[i,r(t).name]])]),e("div",x,[n(e("input",{"onUpdate:modelValue":a[1]||(a[1]=s=>r(t).manufacturer=s),type:"text",placeholder:"Manufacturer",class:"input-filter-l w-56"},null,512),[[i,r(t).manufacturer]])]),e("div",g,[h,n(e("select",{"onUpdate:modelValue":a[2]||(a[2]=s=>r(t).perPage=s),id:"perPage",class:"input-filter-l w-28"},y,512),[[f,r(t).perPage]])]),e("div",{class:"flex flex-nowrap items-center"},[M,e("button",{type:"reset",onClick:u,class:"btn-normal"},"Clear")])])],32))}};export{F as default};