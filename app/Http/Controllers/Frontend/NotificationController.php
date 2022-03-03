<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
  public function index()
  {
    $notifications = auth()->user()->notifications()->paginate(10);

    if (request()->ajax()) {
      if (!$notifications->count()) {
        return response()->json([
          'html' => null,
        ]);
      } else {
        $view = view('frontend.notifications.notifications-data', compact('notifications'))->render();
        return response()->json([
          'html' => $view,
        ]);
      }
    }

    return view('frontend.notifications.index', compact('notifications'));
  }

  public function show($id)
  {
    $notification = auth()->user()->notifications()->where('id', $id)->firstOrFail();
    $notification->markAsRead();

    return view('frontend.notifications.show', compact('notification'));
  }

  public function markAsRead()
  {
    $noti_id = request('noti_id');
    $notification = auth()->user()->unreadnotifications()->where('id', $noti_id)->first();
    if (!$notification) {
      return response()->json([
        'status' => 'fail',
        'data' => null,
      ]);
    }
    $notification->markAsRead();
    $notifications = auth()->user()->notifications()->paginate(10);
    $view = view('frontend.notifications.notifications-data', compact('notifications'))->render();

    return response()->json([
      'status' => 'success',
      'data' => $view,
    ]);
  }

  public function markAsUnRead()
  {
    $noti_id = request('noti_id');
    $notification = auth()->user()->notifications()->where('id', $noti_id)->first();
    if (!$notification) {
      return response()->json([
        'status' => 'fail',
        'data' => null,
      ]);
    }
    $notification->update([
      'read_at' => null,
    ]);
    $notifications = auth()->user()->notifications()->paginate(10);
    $view = view('frontend.notifications.notifications-data', compact('notifications'))->render();

    return response()->json([
      'status' => 'success',
      'data' => $view,
    ]);
  }

  public function destroy()
  {
    $id = request('id');
    $notification = auth()->user()->notifications()->where('id', $id)->first();
    if (!$notification) {
      return response()->json([
        'status' => 'fail',
        'data' => null,
      ]);
    }

    $notification->delete();
    $notifications = auth()->user()->notifications()->paginate(10);
    $view = view('frontend.notifications.notifications-data', compact('notifications'))->render();

    return response()->json([
      'status' => 'success',
      'data' => $view,
    ]);
  }

  public function markAllAsRead()
  {
    $notifications = auth()->user()->unreadnotifications;
    $notifications->markAsRead();
    $notifications = auth()->user()->notifications()->paginate(10);
    $view = view('frontend.notifications.notifications-data', compact('notifications'))->render();

    return response()->json([
      'status' => 'success',
      'data' => $view,
    ]);
  }
}
