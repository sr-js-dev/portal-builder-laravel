<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Model\Page;
use Validator;
use App\Http\Resources\Page as PageResource;
   
class PageController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction()
    {
        $page = Page::all();
    
        return $this->sendResponse(PageResource::collection($page), 'Pages retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAction(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'page_type' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $product = Page::create($input);
   
        return $this->sendResponse(new Page123Resource($product), 'Page created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPageByIdAction($id)
    {
        $page = Page::find($id);
        if (is_null($page)) {
            return $this->sendError('Page not found.');
        }
   
        return $this->sendResponse(new PageResource($page), 'Page retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePageAction(Request $request)
    {
        $input = $request->all();
        $page = Page::find($input['id']);
        $validator = Validator::make($input, [
            'title' => 'required',
            'page_type' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $page->title = $input['title'];
        $page->page_type = $input['page_type'];
        $page->save();
   
        return $this->sendResponse(new PageResource($page), 'Page updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePageAction($id)
    { 
        $page = Page::find($id);
        $page->delete();
   
        return $this->sendResponse([], 'Product deleted successfully.');
    }
}