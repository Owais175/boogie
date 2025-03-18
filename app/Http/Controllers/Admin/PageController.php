<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use Illuminate\Http\Request;
use Image;
use File;
use DB;
use App\Section;


class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $page = Page::where('page_name', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $page = Page::paginate($perPage);
            }

            return view('admin.page.index', compact('page'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
            return view('admin.page.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
            $this->validate($request, [
			'page_name' => 'required',
			'name' => 'required',
			// 'content' => 'required'
		]);
            $page = new page;

            $page->page_name = $request->input('page_name');
            $page->name = $request->input('name');
            $page->arabic_name = $request->input('arabic_name');
            $page->content = $request->input('content');
            $page->arabic_content = $request->input('arabic_content');
            $file = $request->file('image');
            if ($request->hasFile('image')) {
            $destination_path = 'uploads/pages/';
            $profileImage = date("Ymd").".".$file->getClientOriginalExtension();
            Image::make($file)->save(public_path($destination_path) . DIRECTORY_SEPARATOR. $profileImage);

            $page->image = $destination_path.$profileImage;
			}
            $page->save();
            return redirect('admin/page')->with('flash_message', 'Page added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
            $page = Page::findOrFail($id);
            return view('admin.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
            $page = Page::findOrFail($id);
            return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $check = db::table('section')->where('page_id', $id)->get();
        foreach($check as $checks)
        {
            if($checks->type == 'image')
            {
                if ($request->hasFile($checks->slug)) {

                    $section = section::where('id', $checks->id)->first();
                    $image_path = public_path($section->image);

                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }

                    $file = $request->file($checks->slug);
                    $fileNameExt = $request->file($checks->slug)->getClientOriginalName();
                    $fileNameForm = str_replace(' ', '_', $fileNameExt);
                    $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
                    $fileExt = $request->file($checks->slug)->getClientOriginalExtension();
                    $fileNameToStore = $fileName.$checks->id.'_'.time().'.'.$fileExt;
                    $pathToStore = public_path('uploads/pages/');
                    $file->move(public_path('uploads/pages/'), $fileNameToStore);
                    // Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);
                    DB::table('section')->where('id',$checks->id)
                        ->update(
                            array(
                                'value'=>'uploads/pages/'.$fileNameToStore
                            )
                        );
                }

            }

            elseif($checks->type == 'video')
            {


                if($request->hasFile($checks->slug))
                {

                    $section = section::where('id', $checks->id)->first();
                    $image_path = public_path($section->image);

                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }

                    $file = $request->file($checks->slug);
                    $filenameWithExt= $request->file($checks->slug)->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file($checks->slug)->getClientOriginalExtension();
                    $fileNameToStore = $filename. '_'.time().'.'.$extension;
                    $path =  public_path('uploads/videos/');
                    $file->move('uploads/videos/', $fileNameToStore);
                    DB::table('section')->where('id',$checks->id)
                    ->update(
                        array(
                            'value'=>'uploads/videos/'.$fileNameToStore
                        )
                    );
                }

            }

            else
            {

                 DB::table('section')->where('id',$checks->id)
                ->update(
                    array(
                        'value'=>$request->input($checks->slug),
                    )
                );
            }

        }

            $this->validate($request, [
	 	 	 'page_name' => 'required',
	 	 	 'name' => 'required',
	 	 	//  'content' => 'required'
	 	 ]);
            $requestData = $request->all();


        if ($request->hasFile('image')) {

            $page = page::where('id', $id)->first();
            $image_path = public_path($page->image);

            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/pages/');
            $file->move(public_path('uploads/pages/'), $fileNameToStore);
            // Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/pages/'.$fileNameToStore;
        }


            $page = Page::findOrFail($id);
            $page->update($requestData);
            
            return redirect()->back()->with('message', 'Page updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
            Page::destroy($id);

            return redirect('admin/page')->with('flash_message', 'Page deleted!');

    }
}
