 @extends('principal')

 @section('contenido')

     <template v-if="menu==0">
     <usuarios></usuarios>
     </template>

     <template v-if="menu==1">
    <herramientas></herramientas>
     </template>

     <template v-if="menu==2">
         <equipos></equipos>
     </template>
 @endsection
