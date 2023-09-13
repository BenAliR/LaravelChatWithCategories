<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChatGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupController extends Controller
{


    public function generateUniqueSlug($title)
    {
        // Generate a base slug from the title
        $slug = Str::slug($title);

        // Check if the slug already exists in the database
        $count = ChatGroup::where('link', $slug)->count();

        // If the slug exists, append a unique identifier
        if ($count > 0) {
            $slug = $slug . '-' . uniqid();
        }

        return $slug;
    }

    public function index()
    {
        $chatGroups = ChatGroup::with(['messages', 'members'])->paginate(10);

        return view('dashboard.chatgroups.index', [
            'chatGroups' => $chatGroups,
        ]);
    }
    public function create()
    {
        $categories = Category::all();
        $users = User::all(); // récupère tous les utilisateurs
        return view('dashboard.chatgroups.create', compact('categories','users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            // vos autres règles de validation
            'members' => 'required|array',
            'members.*' => 'exists:users,id',
        ]);

        $chatGroup = ChatGroup::create(

[            'name' => $request->input('name'),
            'link' => $this->generateUniqueSlug($request->input('name')),
    'category_id' => $request->input('category_id'),
    'description' => $request->input('description'),


    ]
        );

        foreach ($request->members as $memberData) {
            $chatGroup->members()->create(

                [

                    'chat_id' => $chatGroup->id,
               'user_id' => $memberData,


                ]

            );
        }
        return redirect()->route('chatgroups.index')
            ->with('success', 'Chat Group created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatGroup $chatGroup)
    {
        $categories = Category::all();
        $users = User::all(); // récupère tous les utilisateurs
        return view('dashboard.chatgroups.edit', [
            'chatGroup' => $chatGroup,
            'categories' => $categories,
        'users' => $users
        ]);
    }

}
