 @extends('principal')

 @section('contenido')
     @if(Auth::check())

         @if(Auth::user()->id_roles == 1)
             <template v-if="menu==0">
                 <usuarios></usuarios>
             </template>

             <template v-if="menu==1">
                 <herramientas></herramientas>
             </template>
             <template v-if="menu==2">
                 <equipos></equipos>
             </template>
             <template v-if="menu==3">
                 <cristaleria></cristaleria>
             </template>
             <template v-if="menu==4">
                 <mueble></mueble>
             </template>
             <template v-if="menu==5">
                 <cubiertos></cubiertos>
             </template>
             <template v-if="menu==6">
                 <limpieza></limpieza>
             </template>

             <template v-if="menu==7">
                 <danados></danados>
             </template>
         @elseif(Auth::user()->id_roles== 2)
             <template v-if="menu==0">
                 <herramientas></herramientas>
             </template>
             <template v-if="menu==1">
                 <herramientas></herramientas>
             </template>
             <template v-if="menu==2">
                 <herramientas></herramientas>
             </template>
             <template v-if="menu==3">
                 <cristaleria></cristaleria>
             </template>
             <template v-if="menu==4">
                 <mueble></mueble>
             </template>
             <template v-if="menu==5">
                 <cubiertos></cubiertos>
             </template>
             <template v-if="menu==6">
                 <limpieza></limpieza>
             </template>

             <template v-if="menu==7">
                 <danados></danados>
             </template>
         @endif

     @endif


 @endsection
