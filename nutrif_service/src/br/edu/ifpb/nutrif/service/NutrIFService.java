package br.edu.ifpb.nutrif.service;

import javax.ws.rs.*;

@Path("service")
public class NutrIFService {

	@GET
	@Path("helloworld")
	public String helloworld() {
		return "Hello World!";
	}

	@GET
	@Path("helloname/{name}")
	public String hello(@PathParam("name") final String name) {
		return "Hello " + name;
	}
}