package br.edu.ifpb.nutrif.service;

import java.util.HashSet;
import java.util.Set;
import javax.ws.rs.core.Application;

public class NutrIFApplication extends Application {
	
	private Set<Object> singletons = new HashSet();
	private Set<Class<?>> empty = new HashSet();

	public NutrIFApplication() {
		// ADD YOUR RESTFUL RESOURCES HERE
		this.singletons.add(new NutrIFService());
	}

	public Set<Class<?>> getClasses() {
		return this.empty;
	}

	public Set<Object> getSingletons() {
		return this.singletons;
	}
}