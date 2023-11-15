<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('entities.index');
    }

    public function fetchEntities()
    {
        $entities = Entity::with('contacts.user', 'users')->get();
        if (count($entities) > 0) {
            return response()->json([
                'status' => true,
                'entities' => $entities,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Entities are available yet',
            ]);
        }
    }

    public function fetchSupplierEntities(){
        $entities = Entity::with('contacts.user', 'users')->where(['type' => 1])->get();
        if (count($entities) > 0) {
            return response()->json([
                'status' => true,
                'entities' => $entities,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Suppliers are available yet',
            ]);
        }
    }

    public function fetchClientEntities(){
        $entities = Entity::with('contacts.user', 'users')->where(['type' => 0])->get();
        if (count($entities) > 0) {
            return response()->json([
                'status' => true,
                'entities' => $entities,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Clients are available yet',
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'integer'],
            'entity' => ['required', 'string', 'min:3', 'unique:entities'],
            'abn' => ['integer'],
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $entity = Entity::create($request->all());
        $entityName = $request->input('entity');
        $manager = new FileExplorerController();
        if ($entity) {
            return response()->json([
                'status' => 1,
                'message' => 'Entity Added Successfully',
                'entityFolderCreated' => $manager->createEntity($entityName)
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function show($entity)
    {
        $jobs = Task::with('site', 'user')->where(['type' => 2, 'entity_id' => $entity])->get();
        $contacts = Contact::with('user')->where(['entity_id' => $entity])->get();
        $entity = Entity::find($entity);
        return view('entities.show', [
            'entity' => $entity,
            'jobs' => $jobs,
            'contacts' => $contacts,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit($entity)
    {
        $entity = Entity::find($entity);
        if ($entity) {
            return response()->json([
                'status' => true,
                'entity' => $entity,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No entity available against this id',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $entity)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'integer'],
            'entity' => ['required', 'string', 'min:3'],
            'abn' => ['integer'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $entity = Entity::find($entity);
        $oldEntityName = $entity->entity;
        $newEntityName = $request->input('entity');
        $oldEntityPath = "explorer/".$oldEntityName;
        $newEntityPath = "explorer/";

        $entity = $entity->update($request->all());

        $manager = new FileExplorerController();

        if ($entity) {
            return response()->json([
                'status' => 1,
                'message' => 'Entity Updated Successfully',
                'entityFolderUpdated' => $manager->saveEditedData(new Request([
                    "name" => $newEntityName,
                    "isDir" => true,
                    "path" => $oldEntityPath,
                    "newParentFolderPath" => $newEntityPath
                ])),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy($entity)
    {
        $entity = Entity::find($entity);
        if ($entity) {
            $entity->delete();
            return response()->json([
                'status' => true,
                'message' => 'Entity deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No entity available against this id',
            ]);
        }
    }
}
