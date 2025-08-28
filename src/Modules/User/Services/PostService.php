<?php

namespace WeeWorxxSDK\SharedResources\Modules\User\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use WeeWorxxSDK\SharedResources\Modules\Post\Models\Post;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\BenefitsRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\PostRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\Post\Repository\Contracts\SkillsRepositoryInterface;
use WeeWorxxSDK\SharedResources\Modules\User\Collections\CheckoutPost;
use WeeWorxxSDK\SharedResources\Modules\User\Services\Contracts\PostServicesInterface;

class PostService implements PostServicesInterface
{
	public function __construct(
		protected PostRepositoryInterface $postRepository,
		protected SkillsRepositoryInterface $skillsRepository,
		protected BenefitsRepositoryInterface $benefitsRepository
	){}

	/**
	 * @return void
	 * @throws \Exception
	 */
	public function create(array|Model $data)
	{
		DB::beginTransaction();
		try {
			if (is_array($data)) {
				return $this->createFromArray($data);
			} else if ($data instanceof Model) {
				return $this->createFromModel($data);
			}
		} catch (\Throwable $exception) {
			DB::rollBack();
			throw new \Exception($exception->getMessage());
		}
	}

	/**
	 * @return void
	 */
	protected function createFromArray(array $data)
	{
		$checkoutPost = new CheckoutPost($data);
		[
			'user' => $user,
			'skills' => $skills,
			'benefits' => $benefits,
			'post' => $post
		] = $checkoutPost->toArray(request());

		// ============================================================
		// Save Post
		// ============================================================
		$post = $this->postRepository->create($post);
		// ============================================================
		// Save Skills if it has one and sync the skills
		// ============================================================
		$createdSkills = $this->skillsRepository->create($skills);
		$post->skills()->sync($createdSkills);
		// ============================================================
		// Save benefits if it has one and sync into the pivot table
		// ============================================================
		$createdBenefits = $this->benefitsRepository->create($benefits);
		$post->benefits()->sync($createdBenefits);

		DB::commit();

		return $post;
	}

	/**
	 * @param Post $post
	 * @return void
	 */
	public function createFromModel(Post $post): bool
	{
		 DB::commit();

		 return true;
	}
}
