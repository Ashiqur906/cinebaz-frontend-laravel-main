<!DOCTYPE html>
<html>
<head><title>Purchase Invoice Report</title>


</head>
<style>
 #border {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#border td, #border th {
  border: 1px solid #ddd;
  padding: 8px;
}

#border tr:nth-child(even){background-color: #f2f2f2;}
</style>

<body>
    <div class="container" style="background-color:#D1D0CF">
        <div class="row">
        <div class="col-md-12">
          <table width="100%">
            <tbody>
                 <tr>
                <td width="100%" style="text-align:center">
                <img src="{{asset('assets/frontend/images/logo.png')}}" style="width:200px;">   
                </td>
              </tr>
            </tbody>
          </table>
        </div>
       </div>
     </div>
     <br/>
    
      <div class="container">
     	 <div class="row">
     	 	<div class="col-md-12">
     	 		<table width="100%" >
            <tbody>
              <tr style="text-align:right">
               <td width="60%">
                   
                        <div>To:</div>
                        <span >{{$getOrder->name}}</span>
                        <p >{{$getOrder->phone}}</p>
                   
                </td>
              
                <td colspan="3"></td>
                <td colspan="1"> 
                    <div>
                    Invoice
                    </div>
                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{$getOrder->code}}</div>
                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{date('dM, Y', strtotime($getOrder->updated_at))}}</div>
                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> 
                        <span class="text-600 text-90">Status:</span> 
                        @if($getOrder->sub_status == 'Active')
                        <span class="badge badge-success badge-pill px-25">{{$getOrder->sub_status}}</span>
                        @elseif($getOrder->sub_status == 'pending')
                        <span class="badge badge-warning badge-pill px-25">{{$getOrder->sub_status}}</span>
                        @else
                        <span class="badge badge-danger badge-pill px-25">{{$getOrder->sub_status}}</span>
                        @endif
                    </div>
              </tr>
            
            </tbody>
          </table>
     	 	</div> 
     	 </div>
     </div>
     <br/>
   
      <div class="container">
       <div class="row">
          <table id="border" width="100%">
                    <thead>
                      <tr>
                        <th width="5%">#</th>  
                        <th width="5%">Image</th>
                        <th width="25%">Description</th>
                        <th width="15%">Deadline</th>
                        <th width="20%">Amount</th>
                      </tr> 
                    </thead>
                    <tbody >
                        @php 
                            $reg_total      = 0;
                            $dis_total   = 0;
                        @endphp
                        @foreach($getOrder->Details as $details)
                        @php 
                            $price = $details->medias->regular_price;
                            $reg_total += $price;
                            $discount = $details->medias->discount_price;
                            $dis_total += $discount;
                        @endphp
                        <tr>
                            <td>#{{$loop->index+1}}</td>
                      
                            <td>  <img src="{{asset($details->medias && $details->medias->featured ? 'storage/'.$details->medias->featured->small : null)}}" style="width:60px;"></td>
                      
                            <td>   <p>{{$details->medias->title_en}}</p></td>
                     
                            <td> {{ $details->deadline }}</td>
                       
                            <td> {{ PayCurrency() }} {{ $price ? $price : 0 }} </td>
                        </tr>
                        <tr>
                        <td colspan="4" style="text-align: right"> SubTotal</td>
                        <td >{{ PayCurrency() }} {{ $reg_total }}</td>
                        </tr>
                        <tr>
                        <td colspan="4" style="text-align: right"> Discount</td>
                        <td >{{ PayCurrency() }} {{ $reg_total - $dis_total }}</td>
                        </tr>
                        <tr>
                        <td colspan="4" style="text-align: right">  Total Amount</td>
                        <td >{{ PayCurrency() }} {{ $dis_total }}</td>
                        </tr>

                        @endforeach
                    </tbody>  

                </table>
       </div>
     </div>
    <br/>
</body>
</html>